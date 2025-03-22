@extends('layouts.app')

@section('title', 'College, Office, and Units')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">College, Office, and Units</h1>
            </div>
            <div class="col-auto ms-auto">
                <select class="form-select" id="filterType">
                    <option value="">Filter by</option>
                    @foreach ($collegeOfficeUnitCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>


        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="addNewCollegeOfficeUnitButton"><i
                                    data-lucide="plus" class="lucide lucide-plus"> </i> Add
                                new college or unit</button>
                        </div>
                        <div class="card-body">
                            <table id="collegeOfficeUnitTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>College, Office, or Unit</th>
                                        <th>Acronym</th>
                                        <th>Type</th>
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
    <div class="modal fade" id="addNewCollegeOfficeUnitModal" tabindex="-1" role="dialog"
        aria-labelledby="addNewCollegeOfficeUnitModal" Label aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New College, Office, or Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewCollegeOfficeUnitForm" action="{{ route('addCollegeOfficeUnits') }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="formAddCollegeUnitName"
                                    name="formAddCollegeUnitName" required placeholder="Enter name">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="formAddCollegeUnitAcronym" class="form-label">Acronym</label>
                                <input type="text" id="formAddCollegeUnitAcronym" name="formAddCollegeUnitAcronym"
                                    class="form-control" placeholder="Enter Acronym">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Type</label>
                                <select class="form-select" id="formAddCollegeUnitType" name="formAddCollegeUnitType"
                                    required>
                                    <option value="">Select Type</option>
                                    @foreach ($collegeOfficeUnitCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
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

    <div class="modal fade" id="editCollegeUnitModal" tabindex="-1" role="dialog" aria-labelledby="editCollegeUnitModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit College, Office, or Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCollegeUnitForm" action="{{ route('updateCollegeOfficeUnits') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <input type="hidden" id="formEditCollegeUnitID" name="formEditCollegeUnitID">
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="formEditCollegeUnitName"
                                    name="formEditCollegeUnitName" required placeholder="Enter name">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Acronym</label>
                                <input type="text" class="form-control" id="formEditCollegeUnitAcronym"
                                    name="formEditCollegeUnitAcronym" required placeholder="Enter acronym">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Type</label>
                                <select class="form-select" id="formEditCollegeUnitType" name="formEditCollegeUnitType"
                                    required>
                                    <option value="">Select Type</option>
                                    @foreach ($collegeOfficeUnitCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
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
        function refreshCollegeUnitTable(type) {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('fetchCollegeOfficeUnits') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    category_id: type,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#collegeOfficeUnitTable').DataTable();
                    table.clear();
                    data.forEach(function(collegeUnits) {
                        var editButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="editCollegeUnit(
                                ${collegeUnits.id}, 
                                '${collegeUnits.acronym}', 
                                '${collegeUnits.college_office_unit_name.replace(/'/g, "\\'")}',
                                ${collegeUnits.category_id}
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                            onclick="deleteCollegeUnit(${collegeUnits.id}, '${collegeUnits.college_office_unit_name}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>`;

                        table.row.add([
                            collegeUnits.college_office_unit_name,
                            collegeUnits.acronym,
                            collegeUnits.category_name,
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
            $('#collegeOfficeUnitTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#collegeOfficeUnitTable_wrapper .col-md-6:eq(0)');



            refreshCollegeUnitTable('');

            // Handle filter change
            $('#filterType').change(function() {
                refreshCollegeUnitTable($(this).val());
            });
        });
    </script>

    <script>
        $('#addNewCollegeOfficeUnitButton').click(function() {
            $('#addNewCollegeOfficeUnitModal').modal('show');
        });

        $('#addNewCollegeOfficeUnitForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('addCollegeOfficeUnits') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formAddCollegeUnitName: $('#formAddCollegeUnitName').val(),
                    formAddCollegeUnitAcronym: $('#formAddCollegeUnitAcronym').val(),
                    formAddCollegeUnitType: $('#formAddCollegeUnitType').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewCollegeOfficeUnitForm')[0].reset();
                    $('#addNewCollegeOfficeUnitModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshCollegeUnitTable($('#filterType').val());
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

        function editCollegeUnit(id, acronym, name, categoryId) {
            console.log('Editing:', {
                id,
                acronym,
                name,
                categoryId
            }); // Debug line

            // Set form values
            $('#formEditCollegeUnitID').val(id);
            $('#formEditCollegeUnitName').val(name);
            $('#formEditCollegeUnitAcronym').val(acronym);

            // Set select value
            $('#formEditCollegeUnitType').val(categoryId);

            // Show modal
            $('#editCollegeUnitModal').modal('show');
        }

        // Handle form submission
        $('#editCollegeUnitForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('updateCollegeOfficeUnits') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#formEditCollegeUnitID').val(),
                    college_office_unit_name: $('#formEditCollegeUnitName').val(),
                    college_office_unit_acronym: $('#formEditCollegeUnitAcronym').val(),
                    college_office_unit_category_id: $('#formEditCollegeUnitType').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#editCollegeUnitModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshCollegeUnitTable($('#filterType').val());
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
        function deleteCollegeUnit(collegeUnitId, collegeUnitName) {
            Swal.fire({
                title: 'Are you sure you want to delete this college, office, or unit?',
                text: `${collegeUnitName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('deleteCollegeOfficeUnit') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            college_office_unit_id: collegeUnitId, // Send the ID via POST data
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                refreshCollegeUnitTable($('#filterType').val());
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshCollegeUnitTable($('#filterType').val());
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>
@endsection
