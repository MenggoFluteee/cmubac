<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Models\BudgetAllocation;
use App\Models\Canvass;
use App\Models\Item;
use App\Models\PPMP;
use App\Models\PurchaseRequest;
use App\Models\RequestedItem;
use App\Models\WholeBudget;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EndUserController extends Controller
{
    //

    public function userDashboard()
    {
        $budgetAllocations = BudgetAllocation::where('college_office_unit_id', Auth::user()->collegeOfficeUnit->id)->get();
        $groupedData = $budgetAllocations->groupBy('wholeBudget.source_of_fund')->map(function ($items) {
            return $items->sum('amount');
        })->toArray();


        return view('end_user.dashboard', compact('groupedData'));
    }

    public function userBudgetsPage(Request $request)
    {
        // Fetch all years
        $years = Year::all();

        // Get the default year from the Year model where is_current = 1
        $defaultYear = Year::where('is_current', 1)->value('year') ?? date('Y');

        // Get the selected year from the request, defaulting to the current year
        $selectedYear = $request->input('filterByYear', $defaultYear);

        // Get the user's college office unit ID
        $collegeOfficeUnitId = Auth::user()->collegeOfficeUnit->id ?? null;

        // Fetch account codes with related budget allocations
        $accountCodes = AccountCode::with(['budgetAllocations' => function ($query) use ($selectedYear, $collegeOfficeUnitId) {
            $query->whereHas('wholeBudget', function ($q) use ($selectedYear) {
                $q->where('year', $selectedYear);
            })->where('college_office_unit_id', $collegeOfficeUnitId);
        }])->get();

        // Get yearly budget data
        $yearlyBudget = WholeBudget::where('year', $selectedYear)->get();

        // Fetch available years sorted in descending order
        $availableYears = WholeBudget::distinct()->pluck('year')->sortDesc();

        return view('end_user.budgets_page', compact(
            'yearlyBudget',
            'selectedYear', // Change 'year' to 'selectedYear' to avoid confusion
            'availableYears',
            'accountCodes',
            'years'
        ));
    }



    public function userRequestItemsPage()
    {

        $requestedItems = RequestedItem::where('college_office_unit_id', Auth::user()->college_office_unit_id)->get();
        return view('end_user.requested_items_page', compact('requestedItems'));
    }

    public function viewRequestedItemDetails($id)
    {

        $requestedItem = RequestedItem::findOrFail($id);
        return view('end_user.requested_item_details_page', compact('requestedItem'));
    }



    public function userPpmpsPage(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $years = Year::all();
        // Filter budget allocations based on the selected year
        $budgetAllocations = BudgetAllocation::where('college_office_unit_id', Auth::user()->college_office_unit_id)
            ->whereHas('wholeBudget', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->get();

        return view('end_user.ppmps_page', compact('year', 'years', 'budgetAllocations'));
    }
    public function endUserPPMPDetails($id)
    {
        $ppmp = PPMP::findOrFail($id);
        return view('end_user.ppmp_details_page', compact('ppmp'));
    }

    public function endUserSubmitPPMPTemplate(Request $request)
    {
        $validatedData = $request->validate([
            'ppmp_id' => 'required|numeric|exists:p_p_m_p_s,id',
            'is_submitted' => 'required|numeric'
        ]);

        $ppmp = PPMP::findOrFail($validatedData['ppmp_id']);

        if ($ppmp &&  $ppmp->ppmpItems->count() <= 0) {
            return  response()->json(['success' => false, 'message' => 'Cannot submit a PPMP template without items!']);
        }
        if ($ppmp && $ppmp->is_submitted == 0) {
            $ppmp->update([
                'is_submitted' => 1
            ]);
            return response()->json(['success' => true, 'message' => 'PPMP Successfully Submitted!']);
        } else if ($ppmp && $ppmp->is_submitted == 1) {
            $ppmp->update([
                'is_submitted' => 0
            ]);
            return response()->json(['success' => true, 'message' => 'PPMP Successfully Unsubmitted!']);
        }

        return response()->json(['success' => false, 'message' => 'There was an error submitting your PPMP Template!']);
    }


    public function userPrPage()
    {
        $years = Year::all();

        $approvedPPMP = PPMP::whereHas('budgetAllocation', function ($query) {
            $query->where('college_office_unit_id', Auth::user()->college_office_unit_id)->where('approval_status', 1);
        })->get();

        $purchaseRequests = PurchaseRequest::where('college_office_unit_id', Auth::user()->college_office_unit_id)->get();

        return view('end_user.purchase_request_page', compact('approvedPPMP', 'purchaseRequests', 'years'));
    }

    public function endUserPRDetails($id)
    {
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        return view('end_user.purchase_request_details_page', compact('purchaseRequest'));
    }


    public function userPoPage()
    {
        return view('end_user.purchase_order_page');
    }
}
