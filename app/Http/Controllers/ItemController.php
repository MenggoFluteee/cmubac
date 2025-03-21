<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\ItemPrice;
use App\Models\RequestedItem;
use App\Models\RequestedItemAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class ItemController extends Controller
{
    public function fetchItems()
    {
        $itemsObject = Item::all();
        $items = [];

        foreach ($itemsObject as $item) {
            $itemPrice = $item->prices->where('is_active', 1)->first();
            $items[] = [
                'id' => $item->id,
                'item_name' => $item->item_name,
                'item_code' => $item->item_code,
                'item_description' => $item->item_description,
                'item_unit_of_measure' => $item->unit_of_measure,
                'is_available' => $item->is_available,
                'is_psdbm' => $item->is_psdbm,
                'item_category_id' => $item->item_category_id ? $item->item_category_id : '0',
                'item_category_name' => $item->itemCategory ? $item->itemCategory->item_category_name : 'No Category',
                'current_price' => $itemPrice ? Number::currency($itemPrice->price, 'PHP') : Number::currency('0.0', 'PHP'),
                'account_code_name' => $item->accountCode->account_name,
                'account_code_id' => $item->account_code_id,
            ];
        }

        return response()->json($items);
    }



    public function addItem(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'item_name' => 'required|string|max:255',
                'item_code' => 'required|string|max:255',
                'item_category_id' => 'required|exists:item_categories,id',
                'item_unit_of_measure' => 'required|string|max:255',
                'item_description' => 'nullable|string',
                'is_available' => 'required|numeric|in:0,1',
                'is_psdbm' => 'required|numeric|in:0,1',
                'item_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            $item = Item::create([
                'item_name' => $validatedData['item_name'],
                'item_code' => $validatedData['item_code'],
                'item_category_id' => $validatedData['item_category_id'],
                'unit_of_measure' => $validatedData['item_unit_of_measure'],
                'item_description' => $validatedData['item_description'],
                'is_available' => $validatedData['is_available'],
                'is_psdbm' => $validatedData['is_psdbm'],
                'added_by' => Auth::user()->id,
            ]);

            ItemPrice::create([
                'item_id' => $item->id,
                'price' => $validatedData['item_price'],
                'is_active' => 1,
                'year' => now()->year, // Automatically sets the current year
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Item added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function updateItem(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|exists:items,id',
                'item_name' => 'required|string|max:255',
                'item_code' => 'required|string|max:255',
                'item_category_id' => 'required|exists:item_categories,id',
                'item_unit_of_measure' => 'required|string|max:255',
                'item_description' => 'nullable|string',
                'is_available' => 'required|numeric|in:0,1',
                'is_psdbm' => 'required|numeric|in:0,1',
                'item_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            $item = Item::findOrFail($validatedData['id']);

            $item->update([
                'item_name' => $validatedData['item_name'],
                'item_code' => $validatedData['item_code'],
                'item_category_id' => $validatedData['item_category_id'],
                'unit_of_measure' => $validatedData['item_unit_of_measure'],
                'item_description' => $validatedData['item_description'],
                'is_available' => $validatedData['is_available'],
                'is_psdbm' => $validatedData['is_psdbm'],
            ]);

            $currentPrice = ItemPrice::where('item_id', $item->id)
                ->where('is_active', 1)
                ->first();

            if (!$currentPrice || $currentPrice->price != $validatedData['item_price']) {
                if ($currentPrice) {
                    $currentPrice->update(['is_active' => 0]);
                }

                ItemPrice::create([
                    'item_id' => $item->id,
                    'price' => $validatedData['item_price'],
                    'is_active' => 1,
                    'year' => now()->year,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteItem(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        $item->prices()->delete();
        $item->delete();



        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully!'
        ]);
    }


    public function addNewItemFromRequest(Request $request)
    {
        $validatedData = $request->validate([
            'updateRequestedItemStatusId' => 'required|integer|exists:requested_items,id',
            'addRequestedItemToItemListStatus' => 'required|integer|in:1,2', // Ensure only 1 (approve) or 2 (disapprove) is accepted
        ]);

        $userId = Auth::id();

        try {
            DB::beginTransaction();

            // Update the requested item status
            $requestedItem = RequestedItem::findOrFail($validatedData['updateRequestedItemStatusId']);
            $requestedItem->updateOrFail([
                'approval_status' => $validatedData['addRequestedItemToItemListStatus'],
            ]);

            // If approved, validate and save the new item
            if ($validatedData['addRequestedItemToItemListStatus'] == 1) {
                try {
                    $validatedDataForNewItem = $request->validate([
                        'addRequestedItemToItemListName' => 'required|string|max:255',
                        'addRequestedItemToItemListDescription' => 'required|string|max:255',
                        'addRequestedItemToItemListUnitOfMeasure' => 'required|string|max:255',
                        'addRequestedItemToItemListCode' => 'required|string|max:255',
                        'addRequestedItemToItemListAttachmentId' => 'required|numeric|exists:requested_item_attachments,id',
                        'addRequestedItemToItemListCategory' => 'required|integer|exists:item_categories,id',
                        'addRequestedItemToItemListAccountCode' => 'required|integer|exists:account_codes,id',
                        'addRequestedItemToItemListAvail' => 'required|integer|in:0,1',
                        'addRequestedItemToItemListPSDBM' => 'required|integer|in:0,1',
                        'addRequestedItemToItemListPrice' => 'required|numeric|min:0', // ✅ New field for explicit item price
                    ]);

                    // Create a new item
                    $newItem = Item::create([
                        'item_name' => $validatedDataForNewItem['addRequestedItemToItemListName'],
                        'item_description' => $validatedDataForNewItem['addRequestedItemToItemListDescription'],
                        'item_code' => $validatedDataForNewItem['addRequestedItemToItemListCode'],
                        'unit_of_measure' => $validatedDataForNewItem['addRequestedItemToItemListUnitOfMeasure'],
                        'is_available' => $validatedDataForNewItem['addRequestedItemToItemListAvail'],
                        'is_psdbm' => $validatedDataForNewItem['addRequestedItemToItemListPSDBM'],
                        'item_category_id' => $validatedDataForNewItem['addRequestedItemToItemListCategory'],
                        'account_code_id' => $validatedDataForNewItem['addRequestedItemToItemListAccountCode'],
                        'added_by' => $userId,
                        'is_psdbm_approved' => 1,
                        'approved_by' => $userId,
                    ]);

                    // Find and update the selected attachment
                    $itemAttachment = RequestedItemAttachment::findOrFail($validatedDataForNewItem['addRequestedItemToItemListAttachmentId']);
                    $itemAttachment->update(['is_selected' => 1]);

                    // Create a price entry using the explicit price
                    ItemPrice::create([
                        'item_id' => $newItem->id,
                        'price' => $validatedDataForNewItem['addRequestedItemToItemListPrice'], // ✅ Uses explicit price
                        'is_active' => 1,
                        'year' => now()->year
                    ]);

                    $message = 'Approval of new item successful. The item is now on the list of registered items!';
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with([
                        'success' => false,
                        'message' => 'Error validating new item: ' . $e->getMessage()
                    ]);
                }
            } else {
                $message = 'The item request has been disapproved.';
            }

            DB::commit();
            return redirect()->back()->with(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Error processing the request: ' . $e->getMessage()
            ]);
        }
    }
}
