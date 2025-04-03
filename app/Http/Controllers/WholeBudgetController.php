<?php

namespace App\Http\Controllers;

use App\Models\WholeBudget;
use App\Http\Requests\StoreWholeBudgetRequest;
use App\Http\Requests\UpdateWholeBudgetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class WholeBudgetController extends Controller
{
    public function fetchYearlyBudget(Request $request)
    {

        $wholeBudgetRaw = WholeBudget::where('year', $request->year)->get();

        $wholeBudgets = [];

        foreach ($wholeBudgetRaw as $wholeBudget) {
            $wholeBudgets[] = [
                'id' => $wholeBudget->id,
                'amount' => $wholeBudget->amount ? Number::currency($wholeBudget->amount, 'PHP') : 0.0,
                'year' => $wholeBudget->year,
                'sourceOfFund' => $wholeBudget->source_of_fund,
                'typeOfBudget' => $wholeBudget->type_of_budget,
            ];
        }
        return response()->json($wholeBudgets);
    }

    public function addNewYearlyBudget(Request $request)
    {
        $validatedData = $request->validate([
            'formAddYearlyBudgetYear' => 'required|numeric',
            'formAddYearlyBudgetSourceOfFund' => 'required|string|max:255',
            'formAddYearlyBudgetType' => 'required|string|max:255',
            'formAddYearlyBudgetAmount' => 'required|numeric',
        ]);

        WholeBudget::create([
            'amount' => $validatedData['formAddYearlyBudgetAmount'],
            'year' => $validatedData['formAddYearlyBudgetYear'],
            'source_of_fund' => $validatedData['formAddYearlyBudgetSourceOfFund'],
            'type_of_budget' => $validatedData['formAddYearlyBudgetType'],
        ]);

        return response()->json(['success' => true, 'message' => Number::currency($validatedData['formAddYearlyBudgetAmount'], 'PHP') . ' budget for year ' . $validatedData['formAddYearlyBudgetYear'] . ' successfully added!']);
    }

    public function editYearlyBudget(Request $request)
    {

        $validatedData = $request->validate([
            'formEditYearlyBudgetId' => 'required|numeric|exists:whole_budgets,id',
            'formEditYearlyBudgetYear' => 'required|numeric',
            'formEditYearlyBudgetSourceOfFund' => 'required|string|max:255',
            'formEditYearlyBudgetType' => 'required|string|max:255',
            'formEditYearlyBudgetAmount' => 'required|numeric',
        ]);

        $wholeBudget = WholeBudget::findOrFail($validatedData['formEditYearlyBudgetId']);

        if ($wholeBudget) {
            $wholeBudget->update([
                'amount' => $validatedData['formEditYearlyBudgetAmount'],
                'year' => $validatedData['formEditYearlyBudgetYear'],
                'source_of_fund' => $validatedData['formEditYearlyBudgetSourceOfFund'],
                'type_of_budget' => $validatedData['formEditYearlyBudgetType'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'The budget for the year ' . $validatedData['formEditYearlyBudgetYear'] . ' was successfully updated!']);
    }

    public function deleteYearlyBudget(Request $request)
    {

        $wholeBudget = WholeBudget::findOrFail($request->id);


        $wholeBudget->delete();


        return response()->json([
            'success' => true,
            'message' => 'Budget for the year ' . $request->year . ' with an amount of ' . $request->amount . ' deleted successfully!'
        ]);
    }
}
