<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Models\CollegeOfficeUnit;
use App\Models\CollegeOfficeUnitCategory;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class AdminController extends Controller
{
    //

    public function adminDashboard()
    {
        $items = Item::all();
        $units = CollegeOfficeUnit::all();
        $accountCodes = AccountCode::all();
        $users = User::all();
        return view('admin.dashboard', compact('items', 'units', 'accountCodes', 'users'));
    }

    public function adminCollegeUnitsPage()
    {
        $collegeOfficeUnitCategories = CollegeOfficeUnitCategory::all();
        return view('admin.college_units_page', compact('collegeOfficeUnitCategories'));
    }

    public function adminItemCategoriesPage()
    {
        $itemCategories = ItemCategory::all();
        return view('admin.item_categories_page', compact('itemCategories'));
    }

    public function adminItemsPage()
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
            ];
        }
        $itemCategories = ItemCategory::all();
        return view('admin.items_page', compact('items', 'itemCategories'));
    }

    public function adminAccountCodesPage()
    {
        return view('admin.account_codes_page');
    }

    public function adminUserManagementPage()
    {

        $roles = Role::all();
        $units = CollegeOfficeUnit::all();
        return view('admin.user_management_page', compact('roles', 'units'));
    }

    public function adminUserDetailsPage($id)
    {
        $user = User::find($id);
        $allPrivileges = Privilege::all();
        $collegeOfficeUnits = CollegeOfficeUnit::all();
        return view('admin.user_details', compact('user', 'allPrivileges', 'collegeOfficeUnits'));
    }
}
