<?php

namespace App\Http\Controllers;

use App\Models\Signatory;
use Illuminate\Http\Request;

class SignatoryController extends Controller
{
    //

    public function fetchSignatory()
    {
        $signatories = Signatory::all();

        return response()->json($signatories);
    }

    public function adminAddSignatory(Request $request)
    {
        $validatedData = $request->validate([
            'signatoryFullName' => 'required|string|max:255',
            'signatoryLabel' => 'required|string|max:255',
            'signatoryDescription' => 'nullable|string|max:255',
        ]);

        Signatory::create([
            'fullname' => $validatedData['signatoryFullName'],
            'label' => $validatedData['signatoryLabel'],
            'description' => $validatedData['signatoryDescription'],
        ]);

        return response()->json(['success' => true, 'message' => 'Signatory Successfully Added!']);
    }

    public function adminEditSignatory(Request $request)
    {
        $validatedData = $request->validate([
            'signatoryId' => 'required|numeric|exists:signatories,id',
            'signatoryFullName' => 'required|string|max:255',
            'signatoryLabel' => 'required|string|max:255',
            'signatoryDescription' => 'nullable|string|max:255',
        ]);

        $signatory = Signatory::findOrFail($validatedData['signatoryId']);

        $signatory->update([
            'fullname' => $validatedData['signatoryFullName'],
            'label' => $validatedData['signatoryLabel'],
            'description' => $validatedData['signatoryDescription'],
        ]);

        return response()->json(['success' => true, 'message' => 'Signatory Successfully Updated!']);
    }

    public function adminDeleteSignatory(Request $request)
    {
        $validatedData = $request->validate([
            'signatoryId' => 'required|numeric|exists:signatories,id'
        ]);


        $signatory = Signatory::findOrFail($validatedData['signatoryId']);

        if ($signatory) {
            $signatory->delete();
        }

        return response()->json(['success' => true, 'message' => 'Signatory Successfully Deleted!']);
    }
}
