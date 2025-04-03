<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class YearController extends Controller
{
    //
    public function addYear(Request $request)
    {
        $validatedData = $request->validate([
            'year' => [
                'required',
                'numeric',
                Rule::unique('years', 'year'), // This checks if the year already exists
            ],
        ]);

        // Now you can safely add the year
        Year::create([
            'year' => $validatedData['year'],
            'is_current' => 0, // Set to 0 by default
        ]);

        return redirect()->back()->with('success', 'Year added successfully');
    }

    public function updateYear(Request $request)
    {
        $validatedData = $request->validate([
            'selectYear' => 'required|numeric|exists:years,id',
        ]);

        // First, set all years to is_current = 0
        Year::query()->update(['is_current' => 0]);

        // Then, set the selected year to is_current = 1
        $year = Year::findOrFail($validatedData['selectYear']);
        $year->update([
            'is_current' => 1,
        ]);

        return redirect()->back()->with('success', 'Current year updated successfully');
    }
}
