@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">User Management</h1>
            </div>



        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="addNewUserButton"><i data-lucide="plus"
                                    class="lucide lucide-plus"> </i> Add
                                new user</button>
                        </div>
                        <div class="card-body">
                            <table id="userTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>College, Office, or Unit</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNewUserModal" tabindex="-1" role="dialog" aria-labelledby="addNewUserModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewUserForm" action="{{ route('addUser') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">First Name <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="formAddUserFirstName"
                                        name="formAddUserFirstName" required placeholder="Enter First Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Middle Name </label>
                                    <input type="text" class="form-control" id="formAddUserMiddleName"
                                        name="formAddUserMiddleName" placeholder="Enter Middle Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last Name <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="formAddUserLastName"
                                        name="formAddUserLastName" required placeholder="Enter Last Name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Extension Name</label>
                                    <input type="text" class="form-control" id="formAddUserExtName"
                                        name="formAddUserExtName" placeholder="Enter Extension Name">
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Sex <span style="color: red;">*</span></label>
                                        <select name="formAddUserSex" id="formAddUserSex" class="form-select" required>
                                            <option value="">Sex</option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                    </div>
                                    <div class=" col-6 mb-3">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="formAddUserContactNumber"
                                            name="formAddUserContactNumber" placeholder="Enter Contact Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Role <span style="color: red;">*</span></label>
                                    <select name="formAddUserRole" id="formAddUserRole" class="form-select" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">College, Office, or Unit <span
                                            style="color: red;">*</span></label>
                                    <select name="formAddUserCollegeOfficeUnit" id="formAddUserCollegeOfficeUnit"
                                        class="form-select" required>
                                        <option value="">Select College, Office, or Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->college_office_unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email <span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" id="formAddUserEmail"
                                        name="formAddUserEmail" required placeholder="Enter Email">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        // Function for getting the default fetch of all the college, office, and units 
        function refreshUserTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('fetchUsers') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#userTable').DataTable();
                    table.clear();
                    data.forEach(function(user) {
                        var userDetailButton = `<a href="{{ route('adminUserDetailsPage', '') }}/${user.id}"><button type="button" class="btn btn-sm btn-success me-1" title="View Profile">
                            <i class="fas fa-user"></i> View Details
                        </button></a>`;



                        // Create status icon based on account_status
                        var statusIcon = user.account_status == 1 ?
                            '<i class="fas fa-check-circle text-success" style="font-size: 1.2em;"></i>' :
                            '<i class="fas fa-times-circle text-danger" style="font-size: 1.2em;"></i>';

                        table.row.add([
                            user.full_name,
                            user.email,
                            user.role_name,
                            user.college_office_unit_name,
                            statusIcon, // Replace status value with icon
                            userDetailButton
                        ]);
                    });
                    table.draw();
                },
                error: function(xhr, status, error) {
                    hideLoadingIndicator();
                    console.error(xhr.responseText);
                }
            });
        }
        $(document).ready(function() {
            $('#userTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,
                "columnDefs": [{
                    "targets": [4], // Is Available and Is PSDBM columns
                    "className": "text-center"
                }]

            }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
            refreshUserTable();

        });
    </script>

    <script>
        $('#addNewUserButton').click(function() {
            $('#addNewUserModal').modal('show');
        });

        $('#addNewUserForm').on('submit', function(e) {
            e.preventDefault();


            $.ajax({
                url: "{{ route('addUser') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formAddUserFirstName: $('#formAddUserFirstName').val(),
                    formAddUserMiddleName: $('#formAddUserMiddleName').val(),
                    formAddUserLastName: $('#formAddUserLastName').val(),
                    formAddUserExtName: $('#formAddUserExtName').val(),
                    formAddUserRole: $('#formAddUserRole').val(),
                    formAddUserCollegeOfficeUnit: $('#formAddUserCollegeOfficeUnit').val(),
                    formAddUserEmail: $('#formAddUserEmail').val(),
                    formAddUserSex: $('#formAddUserSex').val(),
                    formAddUserContactNumber: $('#formAddUserContactNumber').val(),
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewUserForm')[0].reset();
                    $('#addNewUserModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshUserTable();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong.'
                    });
                    console.error(xhr.responseText);
                }
            });
        });
    </script>




@endsection
