<?php

namespace App\Http\Controllers;

use App\Models\PPMPItem;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
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

        $collegeOfficeUnit = Auth::user()->collegeOfficeUnit;
        $collegeAcronym = $collegeOfficeUnit->acronym ?? implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $collegeOfficeUnit->college_office_unit_name)));
        $yearMonth = date('mY');
        $maxIncrementingNumber = PurchaseRequest::where('college_office_unit_id', Auth::user()->collegeOfficeUnit->id)->max('incrementing_number');
        $incrementingNumber = $maxIncrementingNumber ? $maxIncrementingNumber + 1 : 1;
        $prCode = "{$collegeAcronym}-PR-{$yearMonth}-{$incrementingNumber}";

        $purchaseRequest = PurchaseRequest::create([
            'pr_code' => $prCode,
            'ppmp_id' => $validatedData['formSelectPPMPToPR'],
            'purpose' => $validatedData['purposeOfRequest'],
            'is_submitted' => 0,
            'approval_status' => 0,
            'prepared_by' => Auth::user()->id,
            'college_office_unit_id' => Auth::user()->collegeOfficeUnit->id,
            'incrementing_number' => $incrementingNumber,
        ]);

        // Get all items from the selected PPMP
        $ppmpItems = PPMPItem::where('ppmp_id', $validatedData['formSelectPPMPToPR'])->get();

        // Copy each PPMP item to the Purchase Request Items
        foreach ($ppmpItems as $ppmpItem) {
            PurchaseRequestItem::create([
                'purchase_request_id' => $purchaseRequest->id,
                'item_id' => $ppmpItem->item_id,
                'status' => 0, // Default status, change as needed
                'january_quantity' => $ppmpItem->january_quantity,
                'february_quantity' => $ppmpItem->february_quantity,
                'march_quantity' => $ppmpItem->march_quantity,
                'april_quantity' => $ppmpItem->april_quantity,
                'may_quantity' => $ppmpItem->may_quantity,
                'june_quantity' => $ppmpItem->june_quantity,
                'july_quantity' => $ppmpItem->july_quantity,
                'august_quantity' => $ppmpItem->august_quantity,
                'september_quantity' => $ppmpItem->september_quantity,
                'october_quantity' => $ppmpItem->october_quantity,
                'november_quantity' => $ppmpItem->november_quantity,
                'december_quantity' => $ppmpItem->december_quantity,
            ]);
        }

        return redirect()->back()->with(['success' => true, 'message' => 'Purchase Request created successfully with items copied from PPMP!']);
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
