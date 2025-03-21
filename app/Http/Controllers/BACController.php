<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Models\ItemCategory;
use App\Models\PPMP;
use App\Models\RequestedItem;
use Illuminate\Http\Request;

class BACController extends Controller
{
    //

    public function bacDashboard()
    {
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();

        return view('bac.dashboard', compact('pendingPPMPsCount'));
    }

    public function bacItemsPage()
    {
        $itemAccountCodes = AccountCode::all();
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        $itemCategories = ItemCategory::all();
        return view('bac.items_page', compact('itemCategories', 'pendingPPMPsCount', 'itemAccountCodes'));
    }

    public function bacItemCategoriesPage()
    {
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        return view('bac.item_categories_page', compact('pendingPPMPsCount'));
    }

    public function bacRequestedItemsPage()
    {
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        return view('bac.requested_items_page', compact('pendingPPMPsCount'));
    }

    public function bacViewRequestedItemDetails($id)
    {
        $requestedItem = RequestedItem::findOrFail($id);
        $accountCodes = AccountCode::all();
        $itemCategories = ItemCategory::all();
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        return view('bac.requested_item_details_page', compact('requestedItem', 'pendingPPMPsCount', 'accountCodes', 'itemCategories'));
    }

    public function bacPPMPsPage()
    {
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        return view('bac.ppmp_page', compact('pendingPPMPsCount'));
    }

    public function bacPurchaseRequestPage()
    {
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        return view('bac.purchase_requests_page', compact('pendingPPMPsCount'));
    }


    // BAC FETCH PPMPS
    public function bacFetchPPMPs()
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

    public function bacViewPPMPDetails($id)
    {
        $pendingPPMPsCount = PPMP::where('approval_status', 0)->where('is_submitted', 1)->count();
        $ppmp = PPMP::findOrFail($id);
        return view('bac.view_ppmp_details_page', compact('ppmp', 'pendingPPMPsCount'));
    }
}
