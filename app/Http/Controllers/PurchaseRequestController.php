<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    public function budgetOfficeFetchPurchaseRequests()
    {
        $purchaseRequestsObject = PurchaseRequest::where('is_submitted', 1)->get();

        $purchaseRequestArray = [];

        foreach ($purchaseRequestsObject as $purchaseRequest) {

            $purchaseRequestArray[] = [
                'id' => $purchaseRequest->id,
                'pr_code' => $purchaseRequest->pr_code,
                'college_office_unit' => $purchaseRequest->collegeOfficeUnit->college_office_unit_name,
                'created_by' => $purchaseRequest->preparedBy ? $purchaseRequest->preparedBy->firstname . ' ' . substr($purchaseRequest->preparedBy->middlename, 0, 1) . ' ' . $purchaseRequest->preparedBy->lastname : '',
                'date_submitted' => $purchaseRequest->date_submitted ? Carbon::parse($purchaseRequest->date_submitted)->format('F d, Y') : '',
                'approval_status' => $purchaseRequest->approval_status,
            ];
        }

        return response()->json($purchaseRequestArray);
    }


    public function endUserCreateNewPR(Request $request)
    {
        $validatedData = $request->validate([
            'formSelectPPMPToPR' => 'numeric|exists:p_p_m_p_s,id|required',
            'purposeOfRequest' => 'nullable|string|max:255'
        ]);

        // Get the college office unit data
        $collegeOfficeUnit = Auth::user()->collegeOfficeUnit;

        // Use the acronym if available, otherwise generate one from the full college name
        $collegeAcronym = $collegeOfficeUnit->acronym ?? implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $collegeOfficeUnit->college_office_unit_name)));

        // Get current year and month
        $yearMonth = date('mY');

        // Determine the next incrementing number for PR within the same college
        $maxIncrementingNumber = PurchaseRequest::where('college_office_unit_id', Auth::user()->collegeOfficeUnit->id)
            ->max('incrementing_number');

        $incrementingNumber = $maxIncrementingNumber ? $maxIncrementingNumber + 1 : 1;

        // Construct the PR code
        $prCode = "{$collegeAcronym}-PR-{$yearMonth}-{$incrementingNumber}";

        // Create the new PR
        PurchaseRequest::create([
            'pr_code' => $prCode,
            'ppmp_id' => $validatedData['formSelectPPMPToPR'],
            'purpose' => $validatedData['purposeOfRequest'],
            'is_submitted' => 0,
            'approval_status' => 0,
            'prepared_by' => Auth::user()->id,
            'college_office_unit_id' => Auth::user()->collegeOfficeUnit->id,
            'incrementing_number' => $incrementingNumber,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Purchase Request created successfully!']);
    }

    public function endUserFetchPurchaseRequests()
    {
        $purchaseRequestsObject = PurchaseRequest::where('college_office_unit_id', Auth::user()->collegeOfficeUnit->id)->get();

        $purchaseRequestArray = [];

        foreach ($purchaseRequestsObject as $purchaseRequest) {

            $purchaseRequestArray[] = [
                'id' => $purchaseRequest->id,
                'pr_code' => $purchaseRequest->pr_code,
                'created_by' => $purchaseRequest->preparedBy ? $purchaseRequest->preparedBy->firstname . ' ' . substr($purchaseRequest->preparedBy->middlename, 0, 1) . ' ' . $purchaseRequest->preparedBy->lastname : '',
                'date_submitted' => $purchaseRequest->date_submitted ? Carbon::parse($purchaseRequest->date_submitted)->format('F d, Y') : '',
                'approval_status' => $purchaseRequest->approval_status,
            ];
        }

        return response()->json($purchaseRequestArray);
    }
}
