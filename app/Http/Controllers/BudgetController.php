<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Models\BudgetAllocation;
use App\Models\CollegeOfficeUnit;
use App\Models\Item;
use App\Models\PPMP;
use App\Models\User;
use App\Models\WholeBudget;
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
        return view('budget.yearly_budget_page');
    }

    public function budgetOfficeBudgetAllocationPage()
    {
        $collegeOfficeUnits = CollegeOfficeUnit::all();
        $yearlyBudget = WholeBudget::all();
        $accountCodes = AccountCode::all();
        return view('budget.budget_allocation_page', compact('yearlyBudget', 'collegeOfficeUnits', 'accountCodes'));
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
        $year = $request->input('filterByYear', date('Y'));

        $collegeOfficeUnit = CollegeOfficeUnit::findOrFail($id);

        $accountCodes = AccountCode::with(['budgetAllocations' => function ($query) use ($id, $year) {
            $query->where('college_office_unit_id', $id)
                ->whereHas('wholeBudget', function ($q) use ($year) {
                    $q->where('year', $year);
                })
                ->with(['wholeBudget', 'allocatedBy']);
        }])->get();

        $yearlyBudget = WholeBudget::where('year', $year)->get();
        $availableYears = WholeBudget::distinct()->pluck('year')->sort()->reverse();

        return view('budget.allocate_budget_to_unit_page', compact(
            'collegeOfficeUnit',
            'accountCodes',
            'yearlyBudget',
            'year',
            'availableYears'
        ));
    }



    public function budgetOfficeAccountCodesPage()
    {
        return view('budget.account_codes_page');
    }

    public function budgetPPMPsPage()
    {
        return view('budget.ppmps_page');
    }

    public function budgetFetchPPMPs()
    {
        $ppmps = PPMP::where('is_submitted', 1)->get();

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
}
