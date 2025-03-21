<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Privilege;

class UserController extends Controller
{
    public function fetchUsers()
    {
        $usersRaw = User::all();
        $users = [];
        foreach ($usersRaw as $user) {
            $users[] = [
                'id' => $user->id,
                'full_name' => $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname . ' ' . $user->extname,
                'email' => $user->email,
                'role_name' => $user->role->role_name,
                'college_office_unit_name' => $user->collegeOfficeUnit->college_office_unit_name,
                'account_status' => $user->account_status,
            ];
        }
        return response()->json($users);
    }

    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'formAddUserFirstName' => 'required|string|max:255',
            'formAddUserMiddleName' => 'nullable|string|max:255',
            'formAddUserLastName' => 'required|string|max:255',
            'formAddUserExtName' => 'nullable|string|max:255',
            'formAddUserRole' => 'required|exists:roles,id',
            'formAddUserCollegeOfficeUnit' => 'required|exists:college_office_units,id',
            'formAddUserEmail' => 'required|email:rfc,dns',
            'formAddUserSex' => 'required|in:1,0',
            'formAddUserContactNumber' => 'required|numeric|phone_number|digits:11',
        ]);
        // default password will be cmu@bacapp2024
        User::create([
            'firstname' => $validatedData['formAddUserFirstName'],
            'middlename' => $validatedData['formAddUserMiddleName'],
            'lastname' => $validatedData['formAddUserLastName'],
            'extname' => $validatedData['formAddUserExtName'],
            'sex' => $validatedData['formAddUserSex'],
            'contact_number' => $validatedData['formAddUserContactNumber'],
            'role_id' => $validatedData['formAddUserRole'],
            'college_office_unit_id' => $validatedData['formAddUserCollegeOfficeUnit'],
            'email' => $validatedData['formAddUserEmail'],
            'password' => Hash::make('cmu@bacapp2024'),
            'account_status' => 1,
        ]);
        return response()->json(['message' => 'User added successfully']);
    }

    public function updateUserPersonalInformation(Request $request)
    {

        $validatedData = $request->validate([
            'formUpdateUserId' => 'required|exists:users,id',
            'formUpdateUserFirstName' => 'required|string|max:255',
            'formUpdateUserMiddleName' => 'nullable|string|max:255',
            'formUpdateUserLastName' => 'required|string|max:255',
            'formUpdateUserExtName' => 'nullable|string|max:255',
            'formUpdateUserSex' => 'required|in:1,0',
            'formUpdateUserContactNumber' => 'required|numeric|phone_number|digits:11',
            'formUpdateUserCollegeOfficeUnit' => 'required|exists:college_office_units,id',
        ]);

        $user = User::findOrFail($validatedData['formUpdateUserId']);

        if ($user) {
            $user->update([
                'firstname' => $validatedData['formUpdateUserFirstName'],
                'middlename' => $validatedData['formUpdateUserMiddleName'],
                'lastname' => $validatedData['formUpdateUserLastName'],
                'extname' => $validatedData['formUpdateUserExtName'],
                'sex' => $validatedData['formUpdateUserSex'],
                'contact_number' => $validatedData['formUpdateUserContactNumber'],
                'college_office_unit_id' => $validatedData['formUpdateUserCollegeOfficeUnit'],
            ]);
        }
        return response()->json(['message' => 'User updated successfully']);
    }

    public function updateUserAccount(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'formUpdateUserAccountId' => 'required|exists:users,id',
                'formUpdateUserAccountCurrentPassword' => 'required|string',
                'formUpdateUserAccountNewPassword' => 'required|string|min:8',
                'formUpdateUserAccountVerifyPassword' => 'required|string|min:8',
            ]);

            $user = User::findOrFail($validatedData['formUpdateUserAccountId']);

            // First check if current password matches
            if (!Hash::check($validatedData['formUpdateUserAccountCurrentPassword'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect.'
                ], 422);
            }

            // Then check if new password and verify password match
            if ($validatedData['formUpdateUserAccountNewPassword'] !== $validatedData['formUpdateUserAccountVerifyPassword']) {
                return response()->json([
                    'success' => false,
                    'message' => 'New password and verify password do not match.'
                ], 422);
            }

            // If both checks pass, update the password
            $user->update([
                'password' => Hash::make($validatedData['formUpdateUserAccountNewPassword']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the password.'
            ], 500);
        }
    }

    public function updateUserPrivileges(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'privileges' => 'array',
                'privileges.*' => 'in:create,retrieve,update,delete'
            ]);

            $user = User::findOrFail($validatedData['user_id']);

            // Get privilege IDs for the selected privilege names
            $privilegeIds = [];
            if (!empty($validatedData['privileges'])) {
                $privilegeIds = Privilege::whereIn('privilege_name', $validatedData['privileges'])
                    ->pluck('id')
                    ->toArray();
            }

            // Sync privileges (this will remove unselected ones and add new ones)
            $user->privileges()->sync($privilegeIds);

            return response()->json([
                'success' => true,
                'message' => 'User privileges updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating privileges: ' . $e->getMessage()
            ], 500);
        }
    }
}
