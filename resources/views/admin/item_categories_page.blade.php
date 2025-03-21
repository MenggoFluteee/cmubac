@extends('layouts.app')

@section('title', 'Item Categories')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Item Categories</h1>
            </div>



        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="addNewItemCategoryButton"><i
                                    data-lucide="plus" class="lucide lucide-plus"> </i> Add
                                new item category</button>
                        </div>
                        <div class="card-body">
                            <table id="itemCategoryTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>Category Code</th>
                                        <th>Category Name</th>
                                        <th>Category Description</th>
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
    <div class="modal fade" id="addNewItemCategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="addNewItemCategoryModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewItemCategoryForm" action="{{ route('addItemCategory') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <div class="col-12 mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" id="formAddItemCategoryCode"
                                name="formAddItemCategoryCode" required placeholder="Enter code">
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="formAddItemCategoryName"
                                    name="formAddItemCategoryName" required placeholder="Enter name">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="formAddItemCategoryDescription" name="formAddItemCategoryDescription" rows="3"
                                    required placeholder="Enter description" style="resize: none;"></textarea>
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


    <div class="modal fade" id="editItemCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editItemCategoryModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editItemCategoryForm" action="{{ route('updateItemCategory') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <input type="hidden" id="formEditItemCategoryID" name="formEditItemCategoryID">
                        <div class="col-12 mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" id="formEditItemCategoryCode"
                                name="formEditItemCategoryCode" required placeholder="Enter code">
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="formEditItemCategoryName"
                                    name="formEditItemCategoryName" required placeholder="Enter name">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="formEditItemCategoryDescription" name="formEditItemCategoryDescription"
                                    rows="3" required placeholder="Enter description" style="resize: none;"></textarea>
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
        function refreshItemCategoryTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('fetchItemCategories') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#itemCategoryTable').DataTable();
                    table.clear();
                    data.forEach(function(itemCategory) {
                        var editButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="editItemCategory(
                                ${itemCategory.id}, 
                                '${itemCategory.item_category_name.replace(/'/g, "\\'")}',
                                '${itemCategory.item_category_code.replace(/'/g, "\\'")}',
                                '${itemCategory.item_category_description.replace(/'/g, "\\'")}',
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                            onclick="deleteItemCategory(${itemCategory.id}, '${itemCategory.item_category_name}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>`;

                        table.row.add([
                            itemCategory.item_category_code,
                            itemCategory.item_category_name,
                            itemCategory.item_category_description,
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
            $('#itemCategoryTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#itemCategoryTable_wrapper .col-md-6:eq(0)');



            refreshItemCategoryTable();


        });
    </script>

    <script>
        $('#addNewItemCategoryButton').click(function() {
            $('#addNewItemCategoryModal').modal('show');
        });

        $('#addNewItemCategoryForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('addItemCategory') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    item_category_name: $('#formAddItemCategoryName').val(),
                    item_category_code: $('#formAddItemCategoryCode').val(),
                    item_category_description: $('#formAddItemCategoryDescription').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewItemCategoryForm')[0].reset();
                    $('#addNewItemCategoryModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshItemCategoryTable();
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

        function editItemCategory(id, name, code, description) {


            // Set form values
            $('#formEditItemCategoryID').val(id);
            $('#formEditItemCategoryName').val(name);
            $('#formEditItemCategoryCode').val(code);
            $('#formEditItemCategoryDescription').val(description);

            // Show modal
            $('#editItemCategoryModal').modal('show');
        }

        // Handle form submission
        $('#editItemCategoryForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('updateItemCategory') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#formEditItemCategoryID').val(),
                    item_category_name: $('#formEditItemCategoryName').val(),
                    item_category_code: $('#formEditItemCategoryCode').val(),
                    item_category_description: $('#formEditItemCategoryDescription').val()
                },
                dataType: 'json',
                success: function(response) {
                    $('#editItemCategoryModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshItemCategoryTable();
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
        function deleteItemCategory(itemCategoryId, itemCategoryName) {
            Swal.fire({
                title: 'Are you sure you want to delete this item category?',
                text: `${itemCategoryName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('deleteItemCategory') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            item_category_id: itemCategoryId, // Send the ID via POST data
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                refreshItemCategoryTable();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshItemCategoryTable();
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>
@endsection
