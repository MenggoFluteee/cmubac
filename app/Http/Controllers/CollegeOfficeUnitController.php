<?php

namespace App\Http\Controllers;

use App\Models\CollegeOfficeUnit;
use App\Http\Requests\StoreCollegeOfficeUnitRequest;
use App\Http\Requests\UpdateCollegeOfficeUnitRequest;
use Illuminate\Http\Request;

class CollegeOfficeUnitController extends Controller
{
    public function fetchCollegeOfficeUnits(Request $request)
    {
        if ($request->category_id == null) {
            $collegeUnits = CollegeOfficeUnit::all();
        } else {
            $collegeUnits = CollegeOfficeUnit::where('category_id', $request->category_id)->get();
        }

        $collegeOfficeUnits = [];

        foreach ($collegeUnits as $collegeUnit) {
            $collegeOfficeUnits[] = [
                'id' => $collegeUnit->id,
                'college_office_unit_name' => $collegeUnit->college_office_unit_name,
                'acronym' => $collegeUnit->acronym,
                'category_id' => $collegeUnit->category_id,
                'category_name' => $collegeUnit->category->category_name,
            ];
        }
        return response()->json($collegeOfficeUnits);
    }

    public function addCollegeOfficeUnits(Request $request)
    {
        try {
            $request->validate([
                'formAddCollegeUnitName' => 'required|string|max:255',
                'formAddCollegeUnitType' => 'required|exists:college_office_unit_categories,id',
                'formAddCollegeUnitAcronym' => 'nullable|string|max:255',
            ]);

            CollegeOfficeUnit::create([
                'college_office_unit_name' => $request->formAddCollegeUnitName,
                'acronym' => $request->formAddCollegeUnitAcronym,
                'category_id' => $request->formAddCollegeUnitType
            ]);

            return response()->json([
                'success' => true,
                'message' => 'College, Office, or Unit added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding College, Office, or Unit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateCollegeOfficeUnits(Request $request)
    {
        try {
            $collegeOfficeUnit = CollegeOfficeUnit::findOrFail($request->id);

            $collegeOfficeUnit->update([
                'college_office_unit_name' => $request->college_office_unit_name,
                'acronym' => $request->college_office_unit_acronym,
                'category_id' => $request->college_office_unit_category_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'College, Office, or Unit updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating College, Office, or Unit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteCollegeOfficeUnit(Request $request)
    {
        $collegeOfficeUnit = CollegeOfficeUnit::findOrFail($request->college_office_unit_id);
        $collegeOfficeUnit->delete();

        return response()->json([
            'success' => true,
            'message' => 'College, Office, or Unit deleted successfully!'
        ]);
    }
}
