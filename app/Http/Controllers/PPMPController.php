<?php

namespace App\Http\Controllers;

use App\Models\BudgetAllocation;
use App\Models\PPMP;
use App\Models\PPMPComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PPMPController extends Controller
{




    public function endUserFetchPPMPs(Request $request)
    {
        $year = $request->input('year', date('Y'));

        // Fetch PPMPs with budgetAllocation, wholeBudget, and accountCode
        $ppmps = PPMP::with(['budgetAllocation.wholeBudget', 'budgetAllocation.accountCode'])
            ->whereHas('budgetAllocation', function ($query) use ($year) {
                $query->where('college_office_unit_id', Auth::user()->college_office_unit_id)
                    ->whereHas('wholeBudget', function ($q) use ($year) {
                        $q->where('year', $year);
                    });
            })
            ->get();

        return response()->json($ppmps);
    }


    public function endUserAddNewPPMP(Request $request)
    {
        $validatedData = $request->validate([
            'formAddPPMPAccountCode' => 'required|exists:budget_allocations,id|numeric',
        ]);

        // Get the college office unit data
        $collegeOfficeUnit = Auth::user()->collegeOfficeUnit;

        // Use the acronym if available, otherwise generate one from the full college name
        $collegeAcronym = $collegeOfficeUnit->acronym ?? implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $collegeOfficeUnit->college_office_unit_name)));

        // Fetch the account code name and create its acronym
        $accountCodeName = BudgetAllocation::find($validatedData['formAddPPMPAccountCode'])->accountCode->account_name;
        $accountCodeAcronym = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $accountCodeName)));

        // Get current year and month
        $yearMonth = date('mY');

        // Determine the next incrementing number for the college
        $maxIncrementingNumber = PPMP::whereHas('budgetAllocation', function ($query) {
            $query->where('college_office_unit_id', Auth::user()->college_office_unit_id);
        })->max('incrementing_number');

        $incrementingNumber = $maxIncrementingNumber ? $maxIncrementingNumber + 1 : 1;

        // Construct the PPMP code
        $ppmpCode = "{$collegeAcronym}-{$accountCodeAcronym}-{$yearMonth}-{$incrementingNumber}";

        // Create the new PPMP
        PPMP::create([
            'budget_allocation_id' => $validatedData['formAddPPMPAccountCode'],
            'created_by' => Auth::user()->id,
            'ppmp_code' => $ppmpCode,
            'is_submitted' => 0,
            'approval_status' => 0,
            'incrementing_number' => $incrementingNumber,
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully added a new PPMP!']);
    }


    public function endUserDeletePPMP(Request $request)
    {
        $ppmp = PPMP::findOrFail($request->ppmpId);

        if ($ppmp) {
            if ($ppmp->approval_status == 1 || $ppmp->approval_status == 2 && $ppmp->is_submitted == 1) {
                return response()->json(['success' => false, 'message' => 'Cannot delete PPMP that is already submitted or approved']);
            }
            if ($ppmp->ppmpItems()->exists()) {
                return response()->json(['success' => false, 'message' => 'Cannot delete PPMP with an existing item']);
            }


            $ppmp->delete();

            return response()->json(['success' => true, 'message' => 'PPMP Deletion Successful!']);
        }

        return response()->json(['success' => false, 'message' => 'Coult not found the PPMP!']);
    }

    public function budgetOfficeUpdatePPMPStatus(Request $request)
    {

        $validatedData = $request->validate([
            'formUpdatePPMPStatusId' => 'required|numeric|exists:p_p_m_p_s,id',
            'formUpdatePPMPStatus' => 'required|numeric',
            'formUpdatePPMPStatusComment' => 'nullable|string|max:255',
        ]);

        $ppmp = PPMP::findOrFail($request->formUpdatePPMPStatusId);

        if ($ppmp) {
            $ppmp->update([
                'approval_status' => $validatedData['formUpdatePPMPStatus'],
            ]);
            if ($validatedData['formUpdatePPMPStatusComment']) {
                PPMPComment::create([
                    'ppmp_id' => $validatedData['formUpdatePPMPStatusId'],
                    'comment' =>  $validatedData['formUpdatePPMPStatusComment'],
                    'from_user' => Auth::user()->id,
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Approval Status Successfully Updated!']);
        }
        return response()->json(['success' => true, 'message' => 'Approval Status Update Failed!']);
    }
}
