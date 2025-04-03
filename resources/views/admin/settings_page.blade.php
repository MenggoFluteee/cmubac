@extends('layouts.app')

@section('title', 'College, Office, and Units')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Settings</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">System Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#signatories"
                            role="tab" aria-selected="true">
                            Signatories
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#yearFilter"
                            role="tab" aria-selected="false" tabindex="-1">
                            Year Filter
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#permissions"
                            role="tab" aria-selected="false" tabindex="-1">
                            Permissions
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="signatories" role="tabpanel">

                        <div class="card">
                            <div class="card-header text-end">
                                <button type="button" class="btn btn-success" id="addNewSignatoryButton"><i
                                        data-lucide="plus" class="lucide lucide-plus"> </i> Add
                                    new signatory</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive w-100 table-hover" id="signatoriesTable">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Label</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                    <div class="tab-pane fade" id="yearFilter" role="tabpanel">

                        <div class="card">
                            <div class="card-header text-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addYearModal"><i data-lucide="plus" class="lucide lucide-plus"> </i>
                                    Add
                                    year</button>
                            </div>
                            <div class="card-body">
                                <form id="updateYear" action="{{ route('updateYear') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <select name="selectYear" id="selectYear" class="form-control">
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}"
                                                        {{ $year->is_current == 1 ? 'selected' : '' }}>{{ $year->year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>

                    <div class="tab-pane fade" id="permissions" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Permissions</h5>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewSignatoryModal" tabindex="-1" role="dialog" aria-labelledby="addNewSignatoryModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Signatory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewSignatoryForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-icon">
                                <i class="far fa-fw fa-square-exclamation"></i>
                            </div>
                            <div class="alert-message">
                                <strong>Note!</strong> This signatories are will be displayed on the PPMP, PR, OR Details.
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Full Name <span class="text-muted">(Firstname MiddleInitial.
                                        Lastname, Titles')</span> <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required
                                    placeholder="Enter Full Name">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Label <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="label" name="label" required
                                    placeholder="Enter Label">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter Description"></textarea>
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
    <div class="modal fade" id="editSignatoryModal" tabindex="-1" role="dialog" aria-labelledby="editSignatoryModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Signatory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSignatoryForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <div class="alert-icon">
                                <i class="far fa-fw fa-square-exclamation"></i>
                            </div>
                            <div class="alert-message">
                                <strong>Note!</strong> This signatories are will be displayed on the PPMP, PR, OR Details.
                            </div>
                        </div>

                        <div class="row mb-3">
                            <input type="text" id="signatoryId" name="signatoryId" hidden>

                            <div class="col-12 mb-3">
                                <label class="form-label">Full Name <span class="text-muted">(Firstname MiddleInitial.
                                        Lastname, Titles')</span> <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="edit_fullname" name="edit_fullname"
                                    required placeholder="Enter Full Name">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Label <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="edit_label" name="edit_label" required
                                    placeholder="Enter Label">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="edit_description" id="edit_description" class="form-control" placeholder="Enter Description"></textarea>
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

    <div class="modal fade" id="addYearModal" tabindex="-1" role="dialog" aria-labelledby="addYearModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Year</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addYearForm" action="{{ route('addYear') }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">



                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Year <span style="color: red">*</span></label>
                                <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                </select>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const yearSelect = document.getElementById('year');
                                const currentYear = new Date().getFullYear();
                                const startYear = currentYear - 50; // 50 years in the past
                                const endYear = currentYear + 10; // 10 years in the future

                                // Populate the dropdown with years
                                for (let year = endYear; year >= startYear; year--) {
                                    const option = document.createElement('option');
                                    option.value = year;
                                    option.textContent = year;

                                    // Set current year as selected by default
                                    if (year === currentYear) {
                                        option.selected = true;
                                    }

                                    yearSelect.appendChild(option);
                                }
                            });
                        </script>
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

    <script>
        function refreshSignatoriesTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('adminFetchSignatories') }}",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#signatoriesTable').DataTable();
                    table.clear();
                    data.forEach(function(signatory) {
                        var editButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="editSignatory(
                                ${signatory.id}, 
                                '${signatory.fullname ? signatory.fullname.replace(/'/g, "\\'") : signatory.fullname}',
                                '${signatory.label ? signatory.label.replace(/'/g, "\\'") : signatory.label}',
                                '${signatory.description ? signatory.description.replace(/'/g, "\\'") : ''}',
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                            onclick="deleteSignatory(${signatory.id}, '${signatory.fullname}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>`;

                        table.row.add([
                            signatory.fullname,
                            signatory.label,
                            signatory.description,
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

        $('#addNewSignatoryButton').click(function(e) {
            $('#addNewSignatoryModal').modal('show');
        });

        $('#addNewSignatoryForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('adminAddSignatory') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    signatoryFullName: $('#fullname').val(),
                    signatoryLabel: $('#label').val(),
                    signatoryDescription: $('#description').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewSignatoryForm')[0].reset();
                    $('#addNewSignatoryModal').modal('hide');
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(() => {
                            refreshSignatoriesTable();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }

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

        function editSignatory(id, fullname, label, description) {
            $('#signatoryId').val(id);
            $('#edit_fullname').val(fullname);
            $('#edit_label').val(label);
            $('#edit_description').val(description);

            $('#editSignatoryModal').modal('show');
        }

        $('#editSignatoryForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('adminEditSignatory') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    signatoryId: $('#signatoryId').val(),
                    signatoryFullName: $('#edit_fullname').val(),
                    signatoryLabel: $('#edit_label').val(),
                    signatoryDescription: $('#edit_description').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#editSignatoryForm')[0].reset();
                    $('#editSignatoryModal').modal('hide');
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(() => {
                            refreshSignatoriesTable();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }

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


        function deleteSignatory(id, fullname) {
            Swal.fire({
                title: 'Are you sure you want to delete this signatory?',
                text: `${fullname}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('adminDeleteSignatory') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            signatoryId: id, // Send the ID via POST data
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                refreshSignatoriesTable();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshSignatoriesTable();
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }


        $(document).ready(function() {
            $('#signatoriesTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#signatoriesTable_wrapper .col-md-6:eq(0)');



            refreshSignatoriesTable();

        });
    </script>



@endsection
