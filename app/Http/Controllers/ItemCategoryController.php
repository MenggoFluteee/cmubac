<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;

use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function fetchItemCategories()
    {
        $itemCategories = ItemCategory::all();
        return response()->json($itemCategories);
    }

    public function addItemCategory(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'item_category_name' => 'required|string|max:255',
                'item_category_code' => 'required|string|max:255',
                'item_category_description' => 'required|string|max:255'
            ]);

            ItemCategory::create([
                'item_category_name' => $validatedData['item_category_name'],
                'item_category_code' => $validatedData['item_category_code'],
                'item_category_description' => $validatedData['item_category_description']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item Category added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding Item Category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateItemCategory(Request $request)
    {
        try {


            $itemCategory = ItemCategory::findOrFail($request->id);

            $validatedData = $request->validate([
                'item_category_name' => 'required|string|max:255',
                'item_category_code' => 'required|string|max:255',
                'item_category_description' => 'required|string|max:255'
            ]);

            $itemCategory->update([
                'item_category_name' => $validatedData['item_category_name'],
                'item_category_code' => $validatedData['item_category_code'],
                'item_category_description' => $validatedData['item_category_description']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item Category updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating Item Category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteItemCategory(Request $request)
    {
        $itemCategory = ItemCategory::findOrFail($request->item_category_id);
        $itemCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item Category deleted successfully!'
        ]);
    }
}
