<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\PPMP;
use App\Models\PPMPItem;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class PPMPItemController extends Controller
{
    //

    public function fetchItemsForPPMP(Request $request)
    {
        $ppmp = PPMP::findOrFail($request->ppmp_id);
    
        $query = Item::where('account_code_id', $ppmp->budgetAllocation->accountCode->id);
    
        // Apply search filter if the user has entered a search term
        if ($request->filled('search')) {
            $query->where('item_name', 'LIKE', '%' . $request->search . '%');
        }
    
        // Limit results for performance
        $itemsObject = $query->limit(10)->get();
    
        // Map results for Select2
        $items = $itemsObject->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->item_name, // Select2 requires 'text' instead of 'item_name'
            ];
        });
    
        return response()->json(['results' => $items]);
    }
    



    public function endUserAddItemToPPMP(Request $request)
    {
        $validatedData = $request->validate([
            'ppmpId' => 'required|exists:p_p_m_p_s,id|numeric',
            'itemId' => 'required|exists:items,id|numeric',
            'janMilsQuantity' => 'nullable|numeric|min:0',
            'febMilsQuantity' => 'nullable|numeric|min:0',
            'marMilsQuantity' => 'nullable|numeric|min:0',
            'aprMilsQuantity' => 'nullable|numeric|min:0',
            'mayMilsQuantity' => 'nullable|numeric|min:0',
            'junMilsQuantity' => 'nullable|numeric|min:0',
            'julMilsQuantity' => 'nullable|numeric|min:0',
            'augMilsQuantity' => 'nullable|numeric|min:0',
            'sepMilsQuantity' => 'nullable|numeric|min:0',
            'octMilsQuantity' => 'nullable|numeric|min:0',
            'novMilsQuantity' => 'nullable|numeric|min:0',
            'decMilsQuantity' => 'nullable|numeric|min:0'
        ]);

        $ppmp = PPMP::findOrFail($validatedData['ppmpId']);

        if ($ppmp->is_submitted == 0) {
            PPMPItem::create([
                'ppmp_id' => $validatedData['ppmpId'],
                'item_id' => $validatedData['itemId'],
                'january_quantity' => $validatedData['janMilsQuantity'] ? $validatedData['janMilsQuantity'] : 0,
                'february_quantity' => $validatedData['febMilsQuantity'] ? $validatedData['febMilsQuantity'] : 0,
                'march_quantity' => $validatedData['marMilsQuantity'] ? $validatedData['marMilsQuantity'] : 0,
                'april_quantity' => $validatedData['aprMilsQuantity'] ? $validatedData['aprMilsQuantity'] : 0,
                'may_quantity' => $validatedData['mayMilsQuantity'] ? $validatedData['mayMilsQuantity'] : 0,
                'june_quantity' => $validatedData['junMilsQuantity'] ? $validatedData['junMilsQuantity'] : 0,
                'july_quantity' => $validatedData['julMilsQuantity'] ? $validatedData['julMilsQuantity'] : 0,
                'august_quantity' => $validatedData['augMilsQuantity'] ? $validatedData['augMilsQuantity'] : 0,
                'september_quantity' => $validatedData['sepMilsQuantity'] ? $validatedData['sepMilsQuantity'] : 0,
                'october_quantity' => $validatedData['octMilsQuantity'] ? $validatedData['octMilsQuantity'] : 0,
                'november_quantity' => $validatedData['novMilsQuantity'] ? $validatedData['novMilsQuantity'] : 0,
                'december_quantity' => $validatedData['decMilsQuantity'] ? $validatedData['decMilsQuantity'] : 0,
            ]);
            return response()->json(['success' => true, 'message' => 'Item added to PPMP successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Cannot add new item because PPMP is already submitted!']);
    }

    public function endUserEditPPMPItem(Request $request)
    {
        $validatedData = $request->validate([
            'PPMPItemId' => 'required|exists:p_p_m_p_items,id|numeric',
            'janMilsQuantity' => 'nullable|numeric|min:0',
            'febMilsQuantity' => 'nullable|numeric|min:0',
            'marMilsQuantity' => 'nullable|numeric|min:0',
            'aprMilsQuantity' => 'nullable|numeric|min:0',
            'mayMilsQuantity' => 'nullable|numeric|min:0',
            'junMilsQuantity' => 'nullable|numeric|min:0',
            'julMilsQuantity' => 'nullable|numeric|min:0',
            'augMilsQuantity' => 'nullable|numeric|min:0',
            'sepMilsQuantity' => 'nullable|numeric|min:0',
            'octMilsQuantity' => 'nullable|numeric|min:0',
            'novMilsQuantity' => 'nullable|numeric|min:0',
            'decMilsQuantity' => 'nullable|numeric|min:0'
        ]);

        $PPMPItem = PPMPItem::findOrFail($validatedData['PPMPItemId']);

        if ($PPMPItem && $PPMPItem->ppmp->is_submitted == 0) {
            $PPMPItem->update([
                'january_quantity' => $validatedData['janMilsQuantity'],
                'february_quantity' => $validatedData['febMilsQuantity'],
                'march_quantity' => $validatedData['marMilsQuantity'],
                'april_quantity' => $validatedData['aprMilsQuantity'],
                'may_quantity' => $validatedData['mayMilsQuantity'],
                'june_quantity' => $validatedData['junMilsQuantity'],
                'july_quantity' => $validatedData['julMilsQuantity'],
                'august_quantity' => $validatedData['augMilsQuantity'],
                'september_quantity' => $validatedData['sepMilsQuantity'],
                'october_quantity' => $validatedData['octMilsQuantity'],
                'november_quantity' => $validatedData['novMilsQuantity'],
                'december_quantity' => $validatedData['decMilsQuantity'],
            ]);

            return response()->json(['success' => true, 'message' => 'Item Milestone Updated Successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Item Milestone Update Failed! Cannot edit items if the PPMP is already submitted.']);
    }

    public function endUserDeleteItemFromPPMP(Request $request)
    {
        $item = PPMPItem::findOrFail($request->item_id);

        if ($item && $item->ppmp->is_submitted == 0) {
            $item->delete();

            return response()->json(['success' => true, 'message' => 'Item successfully deleted!']);
        }

        return response()->json(['success' => false, 'message' => 'Item deletion failed. Cannot delete item when the PPMP is alreadry submitted.']);
    }
}
