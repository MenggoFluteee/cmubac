<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Models\BudgetAllocation;
use App\Models\CollegeOfficeUnit;
use App\Models\Item;
use App\Models\PPMP;
use App\Models\PurchaseRequest;
use App\Models\User;
use App\Models\WholeBudget;
use App\Models\Year;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    //

    public function budgetOfficeDashboard()
    {
        $items = Item::all();
        $units = CollegeOfficeUnit::all();
        $accountCodes = AccountCode::all();
        $users = User::all();
        return view('budget.dashboard', compact('items', 'units', 'accountCodes', 'users'));
    }

    public function budgetOfficeYearlyBudgetPage()
    {
        $years = Year::all();
        return view('budget.yearly_budget_page', compact('years'));
    }



    public function budgetOfficeBudgetAllocationV2Page()
    {
        $collegeOfficeUnits = CollegeOfficeUnit::all();
        $yearlyBudget = WholeBudget::all();
        $accountCodes = AccountCode::all();
        return view('budget.budget_allocation_v2_page', compact('yearlyBudget', 'collegeOfficeUnits', 'accountCodes'));
    }

    public function allocateBudgetToCollegeOfficeUnitPage($id, Request $request)
    {
        // Get all years from the Year model
        $years = Year::all();

        // Get the current year (where is_current = 1) or fall back to the current calendar year
        $currentYear = Year::where('is_current', 1)->first();
        $defaultYear = $currentYear ? $currentYear->year : date('Y');

        // Get the selected year from the request or use the default year with is_current=1
        $year = $request->input('filterByYear', $defaultYear);

        $collegeOfficeUnit = CollegeOfficeUnit::findOrFail($id);

        $accountCodes = AccountCode::with(['budgetAllocations' => function ($query) use ($id, $year) {
            $query->where('college_office_unit_id', $id)
                ->whereHas('wholeBudget', function ($q) use ($year) {
                    $q->where('year', $year);
                })
                ->with(['wholeBudget', 'allocatedBy']);
        }])->get();

        // Only get whole budgets for the selected year
        $yearlyBudget = WholeBudget::where('year', $year)->get();

        // Get all available years from the WholeBudget table for the dropdown
        $availableYears = WholeBudget::distinct()->pluck('year')->sort()->reverse();

        return view('budget.allocate_budget_to_unit_page', compact(
            'collegeOfficeUnit',
            'accountCodes',
            'yearlyBudget',
            'year',
            'years',
            'availableYears'
        ));
    }



    public function budgetOfficeAccountCodesPage()
    {
        return view('budget.account_codes_page');
    }

    public function budgetPPMPsPage()
    {
        $years = Year::all();
        return view('budget.ppmps_page', compact('years'));
    }

    public function budgetFetchPPMPs(Request $request)
{
    // Get the year from the request, default to the current year
    $year = $request->input('year', date('Y'));

    // Fetch PPMPs where WholeBudget's year matches the selected year
    $ppmps = PPMP::where('is_submitted', 1)
        ->whereHas('budgetAllocation.wholeBudget', function ($query) use ($year) {
            $query->where('year', $year);
        })
        ->get();

    // Format the data
    $ppmpArray = [];

    foreach ($ppmps as $ppmp) {
        $ppmpArray[] = [
            'ppmpId' => $ppmp->id,
            'ppmpCode' => $ppmp->ppmp_code,
            'collegeOfficeUnit' => $ppmp->budgetAllocation->collegeOfficeUnit->college_office_unit_name,
            'createdBy' => $ppmp->createdBy->firstname . ' ' . strtoupper(substr($ppmp->createdBy->middlename, 0, 1)) . '. ' .  $ppmp->createdBy->lastname,
            'dateSubmitted' => $ppmp->updated_at->format('F d, Y'),
            'approvalStatus' => $ppmp->approval_status
        ];
    }

    return response()->json($ppmpArray);
}


    public function budgetViewPPMPDetails($id)
    {

        $ppmp = PPMP::findOrFail($id);
        return view('budget.view_ppmp_details', compact('ppmp'));
    }

    public function budgetOfficePurchaseRequestsPage()
    {
        $years = Year::all();
        return view('budget.purchase_requests_page', compact('years'));
    }

    public function budgetOfficePurchaseRequestDetails($id)
    {
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        return view('budget.purchase_request_details', compact('purchaseRequest'));
    }
}
