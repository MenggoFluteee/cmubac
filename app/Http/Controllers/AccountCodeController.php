<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Http\Requests\StoreAccountCodeRequest;
use App\Http\Requests\UpdateAccountCodeRequest;
use Illuminate\Http\Request;

class AccountCodeController extends Controller
{
    public function fetchAccountCodes()
    {
        $accountCodes = AccountCode::all();
        return response()->json($accountCodes);
    }

    public function addAccountCode(Request $request)
    {
        $validatedData = $request->validate([
            'formAddAccountCode' => 'required|string|max:255',
            'formAddAccountName' => 'required|string|max:255',
        ]);

        AccountCode::create([
            'account_code' => $validatedData['formAddAccountCode'],
            'account_name' => $validatedData['formAddAccountName'],
        ]);

        return response()->json(['success' => true, 'message' => 'Account code added successfully']);
    }

    public function updateAccountCode(Request $request)
    {
        $validatedData = $request->validate([
            'formEditAccountId' => 'required|exists:account_codes,id',
            'formEditAccountCode' => 'required|string|max:255',
            'formEditAccountName' => 'required|string|max:255',
        ]);

        $accountCode = AccountCode::findOrFail($validatedData['formEditAccountId']);

        if ($accountCode) {
            $accountCode->update([
                'account_code' => $validatedData['formEditAccountCode'],
                'account_name' => $validatedData['formEditAccountName'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Account code updated successfully']);
    }

    public function deleteAccountCode(Request $request)
    {
        $validatedData = $request->validate([
            'formDeleteAccountId' => 'required|exists:account_codes,id',
        ]);

        $accountCode = AccountCode::findOrFail($validatedData['formDeleteAccountId']);

        if ($accountCode) {
            $accountCode->delete();
        }

        return response()->json(['success' => true, 'message' => 'Account code deleted successfully']);
    }
}
