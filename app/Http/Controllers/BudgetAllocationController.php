<?php

namespace App\Http\Controllers;

use App\Models\BudgetAllocation;
use App\Http\Requests\StoreBudgetAllocationRequest;
use App\Http\Requests\UpdateBudgetAllocationRequest;
use App\Models\CollegeOfficeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class BudgetAllocationController extends Controller
{
    public function budgetOfficeFetchBudgetAllocations(Request $request)
    {
        // Retrieve the selected year from the request
        $year = $request->input('year');

        // Query the BudgetAllocation model
        $query = BudgetAllocation::query();

        // If a year is provided, filter the results
        if ($year) {
            $query->whereHas('wholeBudget', function ($query) use ($year) {
                $query->where('year', $year);
            });
        }

        $budgetAllocations = $query->get();

        // Format the data for the response
        $budgetAllocationArray = [];

        foreach ($budgetAllocations as $budgetAllocation) {
            $budgetAllocationArray[] = [
                'id' => $budgetAllocation->id,
                'college_office_unit_id' => $budgetAllocation->collegeOfficeUnit->id,
                'college_office_unit_name' => $budgetAllocation->collegeOfficeUnit->college_office_unit_name,
                'budgetAmount' => $budgetAllocation->amount ? Number::currency($budgetAllocation->amount, 'PHP') : '',
                'typeOfFund' => $budgetAllocation->wholeBudget->type_of_budget,
                'sourceOfFund' => $budgetAllocation->wholeBudget->source_of_fund,
                'accountCode' => $budgetAllocation->accountCode->account_name,
                'year' => $budgetAllocation->wholeBudget->year,
            ];
        }

        // Return the filtered data as JSON
        return response()->json($budgetAllocationArray);
    }


    public function addNewBudgetAllocation(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'formSelectCollegeOfficeUnit' => 'required|exists:college_office_units,id|numeric',
                'formSelectWholeBudget' => 'required|exists:whole_budgets,id|numeric',
                'formSelectAccountCode' => 'required|exists:account_codes,id|numeric',
                'formAddBudgetAllocationAmount' => 'required|numeric',
            ]);

            $collegeOfficeUnitName = CollegeOfficeUnit::find($validatedData['formSelectCollegeOfficeUnit']);

            BudgetAllocation::create([
                'college_office_unit_id' => $validatedData['formSelectCollegeOfficeUnit'],
                'whole_budget_id' => $validatedData['formSelectWholeBudget'],
                'amount' => $validatedData['formAddBudgetAllocationAmount'],
                'account_code_id' => $validatedData['formSelectAccountCode'],
                'allocated_by' => Auth::user()->id,
                'date_allocated' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Budget of ' . Number::currency($validatedData['formAddBudgetAllocationAmount'], 'PHP') . ' for ' . $collegeOfficeUnitName->college_office_unit_name . ' allocated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function budgetOfficeFetchBudgetAllocationsV2(Request $request)
    {
        $allocations = BudgetAllocation::with(['wholeBudget', 'accountCode'])
            ->where('account_code_id', $request->account_code_id)
            ->where('college_office_unit_id', $request->college_office_unit_id)
            ->whereHas('wholeBudget', function ($query) use ($request) {
                if ($request->year) {
                    $query->where('year', $request->year);
                }
            })
            ->get();

        return response()->json(['data' => $allocations]);
    }

    public function allocateBudgetToCollegeOfficeUnit(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'collegeOfficeUnitId' => 'required|exists:college_office_units,id|numeric',
                'accountCodeId' => 'required|exists:account_codes,id|numeric',
                'wholeBudgetId' => 'required|exists:whole_budgets,id|max:255',
                'budgetAmount' => 'required|numeric',
                'budgetType' => 'required|string|max:255',
            ]);

            BudgetAllocation::create([
                'college_office_unit_id' => $validatedData['collegeOfficeUnitId'],
                'account_code_id' => $validatedData['accountCodeId'],
                'whole_budget_id' => $validatedData['wholeBudgetId'],
                'amount' => $validatedData['budgetAmount'],
                'allocated_by' => Auth::user()->id,
                'date_allocated' => now(),
            ]);

            return response()->json(['success' => true, 'message' => 'Budget Allocation Successful!']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function budgetOfficeDeleteBudgetAllocation(Request $request)
    {
        $validatedData = $request->validate([
            'budget_allocation_id' => 'required|exists:budget_allocations,id',
        ]);

        $budgetAllocation = BudgetAllocation::findOrFail($validatedData['budget_allocation_id']);

        if ($budgetAllocation) {
            $budgetAllocation->delete();
        }

        return response()->json(['success' => true, 'message' => 'Budget Allocation Successfully Deleted!']);
    }

    public function budgetOfficeEditBudgetAllocation(Request $request)
    {
        $validatedData = $request->validate([
            'budget_allocation_id' => 'required|exists:budget_allocations,id|numeric',
            'whole_budget_id' => 'required|exists:whole_budgets,id|numeric',
            'budget_amount' => 'required|numeric',
            'budget_type' => 'required|string|max:255',
        ]);

        $budgetAllocation = BudgetAllocation::findOrFail($validatedData['budget_allocation_id']);

        if ($budgetAllocation) {
            $budgetAllocation->update([
                'whole_budget_id' => $validatedData['whole_budget_id'],
                'amount' => $validatedData['budget_amount'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Budget Allocation Updated Successfully!']);
    }

    public function fetchBudgetAllocationsForPPMP(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $budgetAllocations = BudgetAllocation::where('college_office_unit_id', Auth::user()->college_office_unit_id)
            ->whereHas('wholeBudget', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->with('accountCode', 'wholeBudget')
            ->get();

        return response()->json($budgetAllocations);
    }
}
