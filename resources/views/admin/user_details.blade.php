@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-4">User Details</h1>

        <div class="row">
            <div class="col-md-3 col-xl-3">

                <div class="card">

                    <div class="card-body text-center">
                        @if ($user->sex == 1)
                            <img src="{{ asset('images/maleProfile.png') }}" alt="Male Profile Picture"
                                class="img-fluid rounded-circle mb-2" width="128" height="128">
                        @else
                            <img src="{{ asset('images/femaleProfile.png') }}" alt="Female Profile Picture"
                                class="img-fluid rounded-circle mb-2" width="128" height="128">
                        @endif
                        <h3 class=" mb-0">{{ $user->firstname }} {{ $user->lastname }}</h3>
                        <div class="text-muted mt-1">
                            {{ $user->collegeOfficeUnit->college_office_unit_name }}
                        </div>
                    </div>

                    <div class="list-group list-group-flush text-center" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                            href="#personalInformation" role="tab" aria-selected="true">
                            Personal Information
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#account"
                            role="tab" aria-selected="false" tabindex="-1">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#roleAndPrivileges"
                            role="tab" aria-selected="false" tabindex="-1">
                            Role and Privileges
                        </a>


                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="personalInformation" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Personal Information</h5>
                            </div>
                            <div class="card-body">
                                <form id="updateUserPersonalInformationForm"
                                    action="{{ route('updateUserPersonalInformation') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="formUpdateUserId" id="formUpdateUserId"
                                        value="{{ $user->id }}">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label">First Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="formUpdateUserFirstName"
                                                name="formUpdateUserFirstName" required placeholder="Enter First Name"
                                                value="{{ $user->firstname }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Middle Name </label>
                                            <input type="text" class="form-control" id="formUpdateUserMiddleName"
                                                name="formUpdateUserMiddleName" placeholder="Enter Middle Name"
                                                value="{{ $user->middlename }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">

                                            <label class="form-label">Last Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="formUpdateUserLastName"
                                                name="formUpdateUserLastName" required placeholder="Enter Last Name"
                                                value="{{ $user->lastname }}">

                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Extension Name</label>
                                            <input type="text" class="form-control" id="formUpdateUserExtName"
                                                name="formUpdateUserExtName" placeholder="Enter Extension Name"
                                                value="{{ $user->extname }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Sex <span style="color: red;">*</span></label>
                                            <select name="formUpdateUserSex" id="formUpdateUserSex" class="form-select"
                                                required>
                                                <option value="">Sex</option>
                                                <option value="1" {{ $user->sex == 1 ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="0" {{ $user->sex == 0 ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                        </div>
                                        <div class=" col-6 mb-3">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" id="formUpdateUserContactNumber"
                                                name="formUpdateUserContactNumber" placeholder="Enter Contact Number"
                                                value="{{ $user->contact_number }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12 ">
                                            <label class="form-label">College, Office, or Unit <span
                                                    style="color: red;">*</span></label>
                                            <select name="formUpdateUserCollegeOfficeUnit"
                                                id="formUpdateUserCollegeOfficeUnit" class="form-select" required>
                                                <option value="">College, Office, or Unit</option>
                                                @foreach ($collegeOfficeUnits as $collegeOfficeUnit)
                                                    <option value="{{ $collegeOfficeUnit->id }}"
                                                        {{ $user->college_office_unit_id == $collegeOfficeUnit->id ? 'selected' : '' }}>
                                                        {{ $collegeOfficeUnit->college_office_unit_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="account" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Account</h5>

                                <form id="updateUserAccountForm" action="{{ route('updateUserAccount') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="formUpdateUserAccountId" id="formUpdateUserAccountId"
                                        value="{{ $user->id }}">
                                    <div class="mb-3">
                                        <label for="formUpdateUserAccountEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="formUpdateUserAccountEmail"
                                            name="formUpdateUserAccountEmail" value="{{ $user->email }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formUpdateUserAccountCurrentPassword" class="form-label">Current
                                            password</label>
                                        <input type="password" class="form-control"
                                            id="formUpdateUserAccountCurrentPassword"
                                            name="formUpdateUserAccountCurrentPassword">

                                    </div>
                                    <div class="mb-3">
                                        <label for="formUpdateUserAccountNewPassword" class="form-label">New
                                            password</label>
                                        <input type="password" class="form-control" id="formUpdateUserAccountNewPassword"
                                            name="formUpdateUserAccountNewPassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formUpdateUserAccountVerifyPassword" class="form-label">Verify
                                            password</label>
                                        <input type="password" class="form-control"
                                            id="formUpdateUserAccountVerifyPassword"
                                            name="formUpdateUserAccountVerifyPassword">
                                    </div>
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="roleAndPrivileges" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Role and Privileges</h5>
                                <form id="privilegeForm">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" name="role_id" disabled>
                                            <option value="{{ $user->role->id }}">{{ $user->role->role_name }}</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Privileges</label>
                                        <div class="row">
                                            @php
                                                function hasPrivilege($user, $privilegeName)
                                                {
                                                    return $user->privileges->contains(
                                                        'privilege_name',
                                                        $privilegeName,
                                                    );
                                                }
                                            @endphp

                                            <div class="col-md-6 mb-2">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="privileges[]"
                                                        value="retrieve"
                                                        {{ hasPrivilege($user, 'retrieve') ? 'checked' : '' }}>
                                                    <span class="form-check-label">
                                                        Retrieve
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="privileges[]"
                                                        value="create"
                                                        {{ hasPrivilege($user, 'create') ? 'checked' : '' }}>
                                                    <span class="form-check-label">
                                                        Create
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="privileges[]"
                                                        value="update"
                                                        {{ hasPrivilege($user, 'update') ? 'checked' : '' }}>
                                                    <span class="form-check-label">
                                                        Update
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="privileges[]"
                                                        value="delete"
                                                        {{ hasPrivilege($user, 'delete') ? 'checked' : '' }}>
                                                    <span class="form-check-label">
                                                        Delete
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $('#updateUserPersonalInformationForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('updateUserPersonalInformation') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formUpdateUserId: $('#formUpdateUserId').val(),
                    formUpdateUserFirstName: $('#formUpdateUserFirstName').val(),
                    formUpdateUserMiddleName: $('#formUpdateUserMiddleName').val(),
                    formUpdateUserLastName: $('#formUpdateUserLastName').val(),
                    formUpdateUserExtName: $('#formUpdateUserExtName').val(),
                    formUpdateUserSex: $('#formUpdateUserSex').val(),
                    formUpdateUserContactNumber: $('#formUpdateUserContactNumber').val(),
                    formUpdateUserCollegeOfficeUnit: $('#formUpdateUserCollegeOfficeUnit').val(),
                },
                success: function(response) {
                    // Update the profile name
                    let fullName = $('#formUpdateUserFirstName').val() + ' ' + $(
                        '#formUpdateUserLastName').val();
                    $('h3.mb-0').text(fullName);



                    // Update college/office/unit name
                    let selectedOffice = $('#formUpdateUserCollegeOfficeUnit option:selected').text();
                    $('.text-muted.mt-1').text(selectedOffice);

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
                    });
                }
            });
        });
    </script>

    <script>
        $('#updateUserAccountForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('updateUserAccount') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formUpdateUserAccountId: $('#formUpdateUserAccountId').val(),
                    formUpdateUserAccountCurrentPassword: $('#formUpdateUserAccountCurrentPassword').val(),
                    formUpdateUserAccountNewPassword: $('#formUpdateUserAccountNewPassword').val(),
                    formUpdateUserAccountVerifyPassword: $('#formUpdateUserAccountVerifyPassword').val(),
                },
                success: function(response) {
                    // Clear password fields
                    $('#formUpdateUserAccountCurrentPassword').val('');
                    $('#formUpdateUserAccountNewPassword').val('');
                    $('#formUpdateUserAccountVerifyPassword').val('');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    });
                },
                error: function(xhr) {

                    // Clear password fields
                    $('#formUpdateUserAccountCurrentPassword').val('');
                    $('#formUpdateUserAccountNewPassword').val('');
                    $('#formUpdateUserAccountVerifyPassword').val('');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
                    });
                }
            });
        });
    </script>


    <script>
        $('#privilegeForm').on('submit', function(e) {
            e.preventDefault();

            let checkedPrivileges = [];
            $('input[name="privileges[]"]:checked').each(function() {
                checkedPrivileges.push($(this).val());
            });

            $.ajax({
                url: "{{ route('updateUserPrivileges') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: {{ $user->id }},
                    privileges: checkedPrivileges
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
                    });
                }
            });
        });
    </script>
@endsection
