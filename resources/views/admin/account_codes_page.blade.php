@extends('layouts.app')

@section('title', 'Account Codes')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Account Codes</h1>
            </div>


        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="addNewAccountCodeButton"><i data-lucide="plus"
                                    class="lucide lucide-plus"> </i> Add
                                new account code</button>
                        </div>
                        <div class="card-body">
                            <table id="accountCodeTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>Account Code</th>
                                        <th>Account Name</th>
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
    <div class="modal fade" id="addNewAccountCodeModal" tabindex="-1" role="dialog"
        aria-labelledby="addNewAccountCodeModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Account Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewAccountCodeForm" action="{{ route('adminAddAccountCode') }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Account Code</label>
                                <input type="text" class="form-control" id="formAddAccountCode" name="formAddAccountCode"
                                    required placeholder="Enter account code">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="formAddAccountName" name="formAddAccountName"
                                    required placeholder="Enter account name">
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


    <div class="modal fade" id="editAccountCodeModal" tabindex="-1" role="dialog" aria-labelledby="editAccountCodeModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Account Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAccountCodeForm" action="{{ route('adminUpdateAccountCode') }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="row mb-3">
                            <input type="text" id="formEditAccountCodeID" name="formEditAccountCodeID" hidden>
                            <div class="col-12 mb-3">
                                <label class="form-label">Account Code</label>
                                <input type="text" class="form-control" id="formEditAccountCode"
                                    name="formEditAccountCode" required placeholder="Enter account code">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="formEditAccountName"
                                    name="formEditAccountName" required placeholder="Enter account name">
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
        // Function for getting the default fetch of all the account codes
        function refreshAccountCodeTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('adminFetchAccountCodes') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#accountCodeTable').DataTable();
                    table.clear();
                    data.forEach(function(accountCode) {
                        var editButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="editAccountCode(
                                ${accountCode.id}, 
                                '${accountCode.account_code.replace(/'/g, "\\'")}',
                                '${accountCode.account_name.replace(/'/g, "\\'")}',
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                            onclick="deleteAccountCode(${accountCode.id}, '${accountCode.account_name}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>`;

                        table.row.add([
                            accountCode.account_code,
                            accountCode.account_name,
                            editButton + deleteButton
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
            $('#accountCodeTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#accountCodeTable_wrapper .col-md-6:eq(0)');



            refreshAccountCodeTable();

        });
    </script>

    <script>
        $('#addNewAccountCodeButton').click(function() {
            $('#addNewAccountCodeModal').modal('show');
        });

        $('#addNewAccountCodeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('adminAddAccountCode') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formAddAccountCode: $('#formAddAccountCode').val(),
                    formAddAccountName: $('#formAddAccountName').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewAccountCodeForm')[0].reset();
                    $('#addNewAccountCodeModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshAccountCodeTable();
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

        function editAccountCode(id, code, name) {

            // Set form values
            $('#formEditAccountCodeID').val(id);
            $('#formEditAccountCode').val(code);
            $('#formEditAccountName').val(name);

            // Show modal
            $('#editAccountCodeModal').modal('show');
        }

        // Handle form submission
        $('#editAccountCodeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('adminUpdateAccountCode') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formEditAccountId: $('#formEditAccountCodeID').val(),
                    formEditAccountCode: $('#formEditAccountCode').val(),
                    formEditAccountName: $('#formEditAccountName').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#editAccountCodeModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshAccountCodeTable();
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



    <script>
        function deleteAccountCode(accountCodeId, accountCodeName) {
            Swal.fire({
                title: 'Are you sure you want to delete this account code?',
                text: `${accountCodeName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('adminDeleteAccountCode') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            formDeleteAccountId: accountCodeId, // Send the ID via POST data
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                refreshAccountCodeTable();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshAccountCodeTable();
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>
@endsection
