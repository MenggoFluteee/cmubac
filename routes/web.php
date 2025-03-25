<?php

use App\Http\Controllers\AccountCodeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BACController;
use App\Http\Controllers\BudgetAllocationController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CanvassController;
use App\Http\Controllers\CollegeOfficeUnitController;
use App\Http\Controllers\EndUserController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PPMPCommentController;
use App\Http\Controllers\PPMPController;
use App\Http\Controllers\PPMPItemController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\RequestedItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WholeBudgetController;
use App\Http\Middleware\CheckRole;
use App\Models\BudgetAllocation;
use App\Models\Canvass;
use App\Models\CollegeOfficeUnit;
use App\Models\PPMP;
use App\Models\PPMPItem;
use App\Models\RequestedItem;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::get('unauthorized-page', [PageController::class, 'unauthorizedPage'])->name('unauthorizedPage');

Route::get('login-v2', function () {
    return view('auth.loginV2');
});

// ADMIN
Route::middleware('auth', CheckRole::class . ':1')->group(function () {
    Route::get('admin-dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('admin-college-units', [AdminController::class, 'adminCollegeUnitsPage'])->name('adminCollegeUnitsPage');
    Route::get('admin-item-categories', [AdminController::class, 'adminItemCategoriesPage'])->name('adminItemCategoriesPage');
    Route::get('admin-items', [AdminController::class, 'adminItemsPage'])->name('adminItemsPage');
    Route::get('admin-account-codes', [AdminController::class, 'adminAccountCodesPage'])->name('adminAccountCodesPage');
    Route::get('admin-user-management', [AdminController::class, 'adminUserManagementPage'])->name('adminUserManagementPage');
    Route::get('admin-user-details/{id}', [AdminController::class, 'adminUserDetailsPage'])->name('adminUserDetailsPage');

    // MANAGING DATA OF COLLEGE OFFICE UNITS
    Route::post('admin-fetch-college-office-units', [CollegeOfficeUnitController::class, 'fetchCollegeOfficeUnits'])->name('fetchCollegeOfficeUnits');
    Route::post('admin-add-college-office-units', [CollegeOfficeUnitController::class, 'addCollegeOfficeUnits'])->name('addCollegeOfficeUnits');
    Route::post('admin-update-college-office-units', [CollegeOfficeUnitController::class, 'updateCollegeOfficeUnits'])->name('updateCollegeOfficeUnits');
    Route::post('admin-delete-college-office-unit', [CollegeOfficeUnitController::class, 'deleteCollegeOfficeUnit'])->name('deleteCollegeOfficeUnit');

    // MANAGING DATA OF ITEM CATEGORIES
    Route::post('admin-fetch-item-categories', [ItemCategoryController::class, 'fetchItemCategories'])->name('fetchItemCategories');
    Route::post('admin-add-item-category', [ItemCategoryController::class, 'addItemCategory'])->name('addItemCategory');
    Route::post('admin-update-item-category', [ItemCategoryController::class, 'updateItemCategory'])->name('updateItemCategory');
    Route::post('admin-delete-item-category', [ItemCategoryController::class, 'deleteItemCategory'])->name('deleteItemCategory');

    // MANAGING DATA OF ITEMS
    Route::post('admin-fetch-items', [ItemController::class, 'fetchItems'])->name('fetchItems');
    Route::post('admin-add-item', [ItemController::class, 'addItem'])->name('addItem');
    Route::post('admin-update-item', [ItemController::class, 'updateItem'])->name('updateItem');
    Route::post('admin-delete-item', [ItemController::class, 'deleteItem'])->name('deleteItem');

    // MANAGING DATA OF ACCOUNT CODES
    Route::post('admin-fetch-account-codes', [AccountCodeController::class, 'fetchAccountCodes'])->name('adminFetchAccountCodes');
    Route::post('admin-add-account-code', [AccountCodeController::class, 'addAccountCode'])->name('adminAddAccountCode');
    Route::post('admin-update-account-code', [AccountCodeController::class, 'updateAccountCode'])->name('adminUpdateAccountCode');
    Route::post('admin-delete-account-code', [AccountCodeController::class, 'deleteAccountCode'])->name('adminDeleteAccountCode');

    // MANAGING OF DATA OF USERS AND ITS ROLES AND PRIVILEGES
    Route::post('admin-fetch-users', [UserController::class, 'fetchUsers'])->name('fetchUsers');
    Route::post('admin-add-user', [UserController::class, 'addUser'])->name('addUser');
    Route::post('admin-update-user', [UserController::class, 'updateUser'])->name('updateUser');
    Route::post('admin-delete-user', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('admin-update-user-privileges', [UserController::class, 'updateUserPrivileges'])->name('updateUserPrivileges');
    Route::post('admin-update-user-personal-information', [UserController::class, 'updateUserPersonalInformation'])->name('updateUserPersonalInformation');
    Route::post('admin-update-user-account', [UserController::class, 'updateUserAccount'])->name('updateUserAccount');
});

// BAC
Route::middleware('auth', CheckRole::class . ':2')->group(function () {
    Route::get('bac-dashboard', [BACController::class, 'bacDashboard'])->name('bacDashboard');
    Route::get('bac-items-page', [BACController::class, 'bacItemsPage'])->name('bacItemsPage');
    Route::get('bac-item-categories-page', [BACController::class, 'bacItemCategoriesPage'])->name('bacItemCategoriesPage');
    Route::get('bac-requested-items-page', [BACController::class, 'bacRequestedItemsPage'])->name('bacRequestedItemsPage');
    Route::get('bac-ppmp-page', [BACController::class, 'bacPPMPsPage'])->name('bacPPMPsPage');
    Route::get('bac-purchase-request-page', [BACController::class, 'bacPurchaseRequestPage'])->name('bacPurchaseRequestPage');

    // BAC ITEM CATEGORIES MANAGEMENT
    Route::post('bac-fetch-item-categories', [ItemCategoryController::class, 'fetchItemCategories'])->name('fetchItemCategories');
    Route::post('bac-add-item-category', [ItemCategoryController::class, 'addItemCategory'])->name('addItemCategory');
    Route::post('bac-update-item-category', [ItemCategoryController::class, 'updateItemCategory'])->name('updateItemCategory');
    Route::post('bac-delete-item-category', [ItemCategoryController::class, 'deleteItemCategory'])->name('deleteItemCategory');

    // BAC ITEM MANAGEMENT
    Route::post('bac-fetch-items', [ItemController::class, 'fetchItems'])->name('fetchItems');
    Route::post('bac-add-item', [ItemController::class, 'addItem'])->name('addItem');
    Route::post('bac-update-item', [ItemController::class, 'updateItem'])->name('updateItem');
    Route::post('bac-delete-item', [ItemController::class, 'deleteItem'])->name('deleteItem');

    // BAC REQUEST ITEMS MANAGEMENT
    Route::post('bac-fetch-requested-items', [RequestedItemController::class, 'fetchRequestedItems'])->name('bacOfficeFetchRequestedItems');
    Route::get('bac-view-requested-item-details/{id}', [BACController::class, 'bacViewRequestedItemDetails'])->name('bacViewRequestedItemDetails');
    Route::post('bac-add-new-item-from-request', [ItemController::class, 'addNewItemFromRequest'])->name('addNewItemFromRequest');

    // BAC PPMP MANAGEMENT
    Route::post('bac-fetch-ppmps', [BACController::class, 'bacFetchPPMPs'])->name('bacFetchPPMPs');
    Route::get('bac-view-ppmp-details/{id}', [BACController::class, 'bacViewPPMPDetails'])->name('bacViewPPMPDetails');
});

// BUDGET
Route::middleware('auth', CheckRole::class . ':3')->group(function () {
    Route::get('budget-office-dashboard', [BudgetController::class, 'budgetOfficeDashboard'])->name('budgetOfficeDashboard');
    Route::get('budget-office-yearly-budget-page', [BudgetController::class, 'budgetOfficeYearlyBudgetPage'])->name('budgetOfficeYearlyBudgetPage');
    Route::get('budget-office-budget-allocation-page', [BudgetController::class, 'budgetOfficeBudgetAllocationPage'])->name('budgetOfficeBudgetAllocationPage');
    Route::get('budget-office-budget-allocation-v2-page', [BudgetController::class, 'budgetOfficeBudgetAllocationV2Page'])->name('budgetOfficeBudgetAllocationV2Page');
    Route::get('budget-office-account-codes-page', [BudgetController::class, 'budgetOfficeAccountCodesPage'])->name('budgetOfficeAccountCodesPage');
    Route::get('budget-ppms-page', [BudgetController::class, 'budgetPPMPsPage'])->name('budgetPPMPsPage');
    Route::get('budget-view-ppmp-details/{id}', [BudgetController::class, 'budgetViewPPMPDetails'])->name('budgetViewPPMPDetails');
    Route::get('budget-office-purchase-requests-page', [BudgetController::class, 'budgetOfficePurchaseRequestsPage'])->name('budgetOfficePurchaseRequestsPage');
    Route::get('budget-office-purchase-requests-details/{id}', [BudgetController::class, 'budgetOfficePurchaseRequestDetails'])->name('budgetOfficePurchaseRequestDetails');


    // Managing the whole budget
    Route::post('budget-office-fetch-whole-budget', [WholeBudgetController::class, 'fetchYearlyBudget'])->name('fetchYearlyBudget');
    Route::post('budget-office-add-new-yearly-budget', [WholeBudgetController::class, 'addNewYearlyBudget'])->name('addNewYearlyBudget');
    Route::post('budget-office-edit-yearly-budget', [WholeBudgetController::class, 'editYearlyBudget'])->name('editYearlyBudget');
    Route::post('budget-office-delete-yearly-budget', [WholeBudgetController::class, 'deleteYearlyBudget'])->name('deleteYearlyBudget');

    // MANAGING ACCOUNT CODES FROM THE BUDGET MODULE
    // MANAGING DATA OF ACCOUNT CODES
    Route::post('budget-office-fetch-account-codes', [AccountCodeController::class, 'fetchAccountCodes'])->name('budgetOfficeFetchAccountCodes');
    Route::post('budget-office-add-account-code', [AccountCodeController::class, 'addAccountCode'])->name('budgetOfficeAddAccountCode');
    Route::post('budget-office-update-account-code', [AccountCodeController::class, 'updateAccountCode'])->name('budgetOfficeUpdateAccountCode');
    Route::post('budget-office-delete-account-code', [AccountCodeController::class, 'deleteAccountCode'])->name('budgetOfficeDeleteAccountCode');

    // MANAGING BUDGET ALLOCATIONS
    Route::post('budget-office-fetch-budget-allocations', [BudgetAllocationController::class, 'budgetOfficeFetchBudgetAllocations'])->name('budgetOfficeFetchBudgetAllocations');
    Route::post('budget-office-add-new-budget-allocation', [BudgetAllocationController::class, 'addNewBudgetAllocation'])->name('addNewBudgetAllocation');

    // MANAGING BUDGET ALLOCATION V2
    Route::post('budget-office-fetch-college-office-unit-to-allocate', [CollegeOfficeUnitController::class, 'fetchCollegeOfficeUnits'])->name('budgetOfficeFetchCollegeOfficeUnitToAllocate');
    Route::get('budget-office-allocate-budget-to-college-office-unit-page/{id}', [BudgetController::class, 'allocateBudgetToCollegeOfficeUnitPage'])->name('allocateBudgetToCollegeOfficeUnitPage');
    Route::post('budget-office-fetch-budget-allocations-v2', [BudgetAllocationController::class, 'budgetOfficeFetchBudgetAllocationsV2'])->name('budgetOfficeFetchBudgetAllocationsV2');
    Route::post('budget-office-allocate-budget-to-college-office-unit', [BudgetAllocationController::class, 'allocateBudgetToCollegeOfficeUnit'])->name('allocateBudgetToCollegeOfficeUnit');
    Route::post('budget-office-delete-budget-allocation', [BudgetAllocationController::class, 'budgetOfficeDeleteBudgetAllocation'])->name('budgetOfficeDeleteBudgetAllocation');
    Route::post('budget-office-edit-budget-allocation', [BudgetAllocationController::class, 'budgetOfficeEditBudgetAllocation'])->name('budgetOfficeEditBudgetAllocation');

    // BUDGET OFFICE MANAGEMENT OF THE PPMPS
    Route::post('budget-office-fetch-ppmps', [BudgetController::class, 'budgetFetchPPMPs'])->name('budgetFetchPPMPs');
    Route::post('budget-office-update-ppmp-status', [PPMPController::class, 'budgetOfficeUpdatePPMPStatus'])->name('budgetOfficeUpdatePPMPStatus');
    Route::post('budget-office-add-comment-to-ppmp', [PPMPCommentController::class, 'budgetOfficeAddCommentToPPMP'])->name('budgetOfficeAddCommentToPPMP');

    // BUDGET OFFICE MANAGEMENT OF PURCHASE REQUESTS
    Route::get('budget-office-fetch-purchase-requests', [PurchaseRequestController::class, 'budgetOfficeFetchPurchaseRequests'])->name('budgetOfficeFetchPurchaseRequests');
});

// USER
Route::middleware('auth', CheckRole::class . ':4')->group(function () {
    Route::get('user-dashboard', [EndUserController::class, 'userDashboard'])->name('userDashboard');
    Route::get('user-budgets-page', [EndUserController::class, 'userBudgetsPage'])->name('userBudgetsPage');
    Route::get('user-request-items-page', [EndUserController::class, 'userRequestItemsPage'])->name('userRequestItemsPage');
    Route::get('user-ppmps-page', [EndUserController::class, 'userPpmpsPage'])->name('userPpmpsPage');
    Route::get('end-user-canvas-form-details/{id}', [EndUserController::class, 'endUserCanvasFormDetails'])->name('endUserCanvasFormDetails');
    Route::get('end-user-ppmp-details/{id}', [EndUserController::class, 'endUserPPMPDetails'])->name('endUserPPMPDetails');
    Route::post('end-user-submit-ppmp', [EndUserController::class, 'endUserSubmitPPMPTemplate'])->name('endUserSubmitPPMPTemplate');

    Route::get('end-user-purchase-request-details/{id}', [EndUserController::class, 'endUserPRDetails'])->name('endUserPRDetails');



    Route::get('user-pr-page', [EndUserController::class, 'userPrPage'])->name('userPrPage');
    Route::get('user-po-page', [EndUserController::class, 'userPoPage'])->name('userPoPage');

    Route::post('end-user-fetch-ppmps', [PPMPController::class, 'endUserFetchPPMPs'])->name('endUserFetchPPMPs');
    Route::post('end-user-add-new-ppmp', [PPMPController::class, 'endUserAddNewPPMP'])->name('endUserAddNewPPMP');
    Route::post('end-user-delete-ppmp', [PPMPController::class, 'endUserDeletePPMP'])->name('endUserDeletePPMP');

    // End user adding of item on PPMP
    // Fetching of items to displat to the PPMP Details Page
    Route::post('fetch-items-for-ppmp', [PPMPItemController::class, 'fetchItemsForPPMP'])->name('fetchItemsForPPMP');

    Route::post('end-user-add-item-to-ppmp', [PPMPItemController::class, 'endUserAddItemToPPMP'])->name('endUserAddItemToPPMP');
    Route::post('end-user-edit-ppmp-item', [PPMPItemController::class, 'endUserEditPPMPItem'])->name('endUserEditPPMPItem');
    Route::post('end-user-delete-item-from-ppmp', [PPMPItemController::class, 'endUserDeleteItemFromPPMP'])->name('endUserDeleteItemFromPPMP');
    Route::post('end-user-add-comment-to-ppmp', [PPMPCommentController::class, 'endUserAddCommentToPPMP'])->name('endUserAddCommentToPPMP');




    // Request New Item
    Route::post('end-user-fetch-requested-item', [RequestedItemController::class, 'fetchRequestedItems'])->name('fetchRequestedItems');
    Route::get('end-user-view-requested-item-details/{id}', [EndUserController::class, 'viewRequestedItemDetails'])->name('endUserViewRequestedItemDetails');
    Route::post('end-user-add-new-requested-item', [RequestedItemController::class, 'addNewRequestedItem'])->name('addNewRequestedItem');
    Route::post('end-user-delete-requested-item', [RequestedItemController::class, 'deleteRequestedItem'])->name('endUserDeleteRequestedItem');


    // PR MANAGEMENT
    Route::get('end-user-fetch-pr', [PurchaseRequestController::class, 'endUserFetchPurchaseRequests'])->name('endUserFetchPurchaseRequests');
    Route::post('end-user-create-new-pr', [PurchaseRequestController::class, 'endUserCreateNewPR'])->name('endUserCreateNewPR');
});
