<?php

namespace App\Http\Controllers;

use App\Models\RequestedItem;
use App\Models\RequestedItemAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RequestedItemController extends Controller
{

    public function fetchRequestedItems()
    {
        $requestedItems = RequestedItem::orderBy('created_at', 'desc')->get();

        $items = [];

        foreach ($requestedItems as $item) {
            $items[] = [
                'id' => $item->id,
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'college_office_unit_name' => $item->collegeOfficeUnit->college_office_unit_name,
                'created_at' => $item->created_at->format('F d, Y'),
                'approval_status' => $item->approval_status,
            ];
        }

        return response()->json($items);
    }
    //
    public function addNewRequestedItem(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'nullable|exists:requested_items,id',
            'formRequestNewItemName' => 'required|string|max:255',
            'formRequestNewItemDescription' => 'nullable|string|max:255',
            'formRequestNewItemUnitOfMeasure' => 'required|string|max:255',

            'formRequestNewItemCompanyName1' => 'required|string|max:255',
            'formRequestNewItemCompanyContact1' => 'required|string|max:255',
            'formRequestNewItemCanvasForm1Price' => 'required|numeric',
            'formRequestNewItemCanvasForm1File' => 'required|file|mimes:pdf|max:3072',

            'formRequestNewItemCompanyName2' => 'required|string|max:255',
            'formRequestNewItemCompanyContact2' => 'required|string|max:255',
            'formRequestNewItemCanvasForm2Price' => 'required|numeric',
            'formRequestNewItemCanvasForm2File' => 'required|file|mimes:pdf|max:3072',

            'formRequestNewItemCompanyName3' => 'required|string|max:255',
            'formRequestNewItemCompanyContact3' => 'required|string|max:255',
            'formRequestNewItemCanvasForm3Price' => 'required|numeric',
            'formRequestNewItemCanvasForm3File' => 'required|file|mimes:pdf|max:3072',
        ]);

        // Check if item with the same ID already exists
        $itemId = $request->input('item_id');
        $existingItem = $itemId ? RequestedItem::find($itemId) : null;

        if ($existingItem) {
            // If item exists but is different from what we're trying to create, update it
            $existingItem->update([
                'item_description' => $validatedData['formRequestNewItemDescription'],
                'unit_of_measure' => $validatedData['formRequestNewItemUnitOfMeasure'],
                'updated_by' => Auth::user()->id,
                'approval_status' => 0, // Reset approval status for the updated item
                'updated_at' => now(),
            ]);

            // Delete existing attachments
            $existingItem->attachments()->delete();

            // Use the existing item's ID
            $newRequestedItem = $existingItem;
            $message = 'Item Request Successfully Updated!';
        } else {
            // Create new item if it doesn't exist
            $newRequestedItem = RequestedItem::create([
                'item_name' => $validatedData['formRequestNewItemName'],
                'item_description' => $validatedData['formRequestNewItemDescription'],
                'unit_of_measure' => $validatedData['formRequestNewItemUnitOfMeasure'],
                'college_office_unit_id' => Auth::user()->college_office_unit_id,
                'created_by' => Auth::user()->id,
                'approval_status' => 0,
            ]);
            $message = 'Item Request Successfully Sent!';
        }

        // Create a single directory for this specific request
        // Use the item name in the directory path to make it more identifiable
        $itemNameSlug = Str::slug($validatedData['formRequestNewItemName']);
        $collegeOfficeUnitNameSlug = Str::slug(Auth::user()->collegeOfficeUnit->college_office_unit_name);
        $directoryPath = 'requested_items/' . $collegeOfficeUnitNameSlug . '/' . $newRequestedItem->id . '_' . $itemNameSlug;

        // Delete existing files if updating
        if ($existingItem) {
            Storage::disk('public')->deleteDirectory($directoryPath);
        }

        for ($i = 1; $i <= 3; $i++) {
            // Get the file
            $file = $request->file("formRequestNewItemCanvasForm{$i}File");

            // Get the original filename without extension
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $sluggedOriginalFileName = Str::slug($originalFileName);

            // Get company name and sanitize it for the filename
            $companyName = $validatedData["formRequestNewItemCompanyName{$i}"];
            $sanitizedCompanyName = Str::slug($companyName);

            // Create new filename with the format: companyName_productName_originalFileName.pdf
            $fileName = $sanitizedCompanyName . '_' . $itemNameSlug . '_' . $sluggedOriginalFileName . '.pdf';

            // Store all 3 files in the same directory
            $filePath = $file->storeAs($directoryPath, $fileName, 'public');

            RequestedItemAttachment::create([
                'requested_item_id' => $newRequestedItem->id,
                'company_name' => $companyName,
                'company_contact_no' => $validatedData["formRequestNewItemCompanyContact{$i}"],
                'item_price' => $validatedData["formRequestNewItemCanvasForm{$i}Price"],
                'file_path' => $filePath
            ]);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }



    public function deleteRequestedItem(Request $request)
    {
        $validatedData = $request->validate([
            'requestedItemId' => 'required|numeric|exists:requested_items,id',
        ]);

        $requestedItem = RequestedItem::findOrFail($validatedData['requestedItemId']);

        DB::beginTransaction(); // Start transaction

        try {
            // Get all attachments
            $attachments = $requestedItem->requestedItemAttachments;

            // Delete files from storage
            foreach ($attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
            }

            // Delete attachment records from database
            $requestedItem->requestedItemAttachments()->delete();

            // Define the directory path
            $itemNameSlug = Str::slug($requestedItem->item_name);
            $collegeOfficeUnitNameSlug = Str::slug($requestedItem->collegeOfficeUnit->college_office_unit_name);
            $directoryPath = 'requested_items/' . $collegeOfficeUnitNameSlug . '/' . $requestedItem->id . '_' . $itemNameSlug;

            // Delete the entire directory
            Storage::disk('public')->deleteDirectory($directoryPath);

            // Delete the requested item record
            $requestedItem->delete();

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Requested item and all its attachments deleted successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if an error occurs

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete requested item and its attachments!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
