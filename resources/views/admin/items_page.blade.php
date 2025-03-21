@extends('layouts.app')

@section('title', 'Items')
@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Items</h1>
            </div>



        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="addNewItemButton"><i data-lucide="plus"
                                    class="lucide lucide-plus"> </i> Add
                                new item</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive w-100 table-hover" id="itemTable">
                                <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Item Category</th>
                                        <th>Unit of Measure</th>
                                        <th>Is Available?</th>
                                        <th>Is PSDBM?</th>
                                        <th>Current Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item['item_code'] }}</td>
                                            <td>{{ $item['item_name'] }}</td>
                                            <td>{{ $item['item_category_name'] }}</td>
                                            <td>{{ $item['item_unit_of_measure'] }}</td>
                                            @if ($item['is_available'] == 0)
                                                <td><i class="fas fa-check-circle text-success"
                                                        style="font-size: 1.2em;"></i></td>
                                            @endif
                                            <td>{{ $item['is_psdbm'] }}</td>
                                            <td>{{ $item['current_price'] }}</td>

                                            <td><button class="btn btn-sm btn-success">asd</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNewItemModal" tabindex="-1" role="dialog" aria-labelledby="addNewItemModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewItemForm" action="{{ route('addItem') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Code</label>
                                <input type="text" class="form-control" id="formAddItemCode" name="formAddItemCode"
                                    required placeholder="Enter code">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="formAddItemName" name="formAddItemName"
                                    required placeholder="Enter name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Category</label>
                                <select name="formAddItemCategory" id="formAddItemCategory" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($itemCategories as $itemCategory)
                                        <option value="{{ $itemCategory->id }}">{{ $itemCategory->item_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Unit of Measure</label>
                                <input type="text" class="form-control" id="formAddItemUnitOfMeasure"
                                    name="formAddItemUnitOfMeasure" required placeholder="Enter unit of measure">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Item Description</label>
                            <textarea type="text" class="form-control" id="formAddItemDescription" name="formAddItemDescription" required
                                placeholder="Enter description" style="resize: none;"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label class="form-label">Is Available?</label>
                                <select name="formAddItemIsAvailable" id="formAddItemIsAvailable" class="form-select">
                                    <option value="" selected>Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Is PSDBM?</label>
                                <select name="formAddItemIsPSDBM" id="formAddItemIsPSDBM" class="form-select">
                                    <option value="" selected>Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Item Price</label>
                            <input type="text" class="form-control" id="formAddItemPrice" name="formAddItemPrice"
                                required placeholder="Enter price">
                            <script>
                                $(document).ready(function() {
                                    $('#formAddItemPrice').inputmask({
                                        alias: 'numeric',
                                        groupSeparator: ',',
                                        autoGroup: true,
                                        digits: 2,
                                        digitsOptional: false,
                                        prefix: '₱', // You can use any currency symbol here
                                        placeholder: '0',
                                        rightAlign: true,
                                        removeMaskOnSubmit: true // Optional, removes mask when form is submitted
                                    });
                                });
                            </script>
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


    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editItemForm" action="{{ route('updateItem') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <input type="text" id="formEditItemID" name="formEditItemID" hidden>
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Code</label>
                                <input type="text" class="form-control" id="formEditItemCode" name="formEditItemCode"
                                    required placeholder="Enter code">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="formEditItemName" name="formEditItemName"
                                    required placeholder="Enter name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Category</label>
                                <select name="formEditItemCategory" id="formEditItemCategory" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($itemCategories as $itemCategory)
                                        <option value="{{ $itemCategory->id }}">{{ $itemCategory->item_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Item Unit of Measure</label>
                                <input type="text" class="form-control" id="formEditItemUnitOfMeasure"
                                    name="formEditItemUnitOfMeasure" required placeholder="Enter unit of measure">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Item Description</label>
                            <textarea type="text" class="form-control" id="formEditItemDescription" name="formEditItemDescription" required
                                placeholder="Enter description" style="resize: none;"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label class="form-label">Is Available?</label>
                                <select name="formEditItemIsAvailable" id="formEditItemIsAvailable" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Is PSDBM?</label>
                                <select name="formEditItemIsPSDBM" id="formEditItemIsPSDBM" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Item Price</label>
                            <input type="text" class="form-control" id="formEditItemPrice" name="formEditItemPrice"
                                required placeholder="Enter price">
                            <script>
                                $(document).ready(function() {
                                    $('#formEditItemPrice').inputmask({
                                        alias: 'numeric',
                                        groupSeparator: ',',
                                        autoGroup: true,
                                        digits: 2,
                                        digitsOptional: false,
                                        prefix: '₱', // You can use any currency symbol here
                                        placeholder: '0',
                                        rightAlign: true,
                                        removeMaskOnSubmit: true // Optional, removes mask when form is submitted
                                    });
                                });
                            </script>
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
        function refreshItemTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('fetchItems') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#itemTable').DataTable();
                    table.clear();
                    data.forEach(function(item) {
                        var editButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="editItem(
                                ${item.id}, 
                                '${item.item_name.replace(/'/g, "\\'")}',
                                '${item.item_code.replace(/'/g, "\\'")}',
                                ${item.item_category_id}, 
                                '${item.item_unit_of_measure.replace(/'/g, "\\'")}',
                                '${item.item_description.replace(/'/g, "\\'")}',
                                ${item.is_available}, 
                                ${item.is_psdbm}, 
                                '${item.current_price.replace(/'/g, "\\'")}',
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                            onclick="deleteItem(${item.id}, '${item.item_name}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>`;

                        // Create icons for is_available and is_psdbm
                        var isAvailableIcon = item.is_available ?
                            '<i class="fas fa-check-circle text-success" style="font-size: 1.2em;"></i>' :
                            '<i class="fas fa-times-circle text-danger" style="font-size: 1.2em;"></i>';

                        var isPSDBMIcon = item.is_psdbm ?
                            '<i class="fas fa-check-circle text-success" style="font-size: 1.2em;"></i>' :
                            '<i class="fas fa-times-circle text-danger" style="font-size: 1.2em;"></i>';

                        table.row.add([
                            item.item_code,
                            item.item_name,
                            item.item_category_name,
                            item.item_unit_of_measure,
                            isAvailableIcon, // Replace boolean with icon
                            isPSDBMIcon, // Replace boolean with icon
                            item.current_price,
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
            $('#itemTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": true,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,
                "columnDefs": [{
                        "targets": [4, 5], // Is Available and Is PSDBM columns
                        "className": "text-center"
                    },
                    {
                        "targets": [6], // Current Price column
                        "className": "text-end" // Right align
                    }
                ]
            }).buttons().container().appendTo('#itemTable_wrapper .col-md-6:eq(0)');

            refreshItemTable();
        });
    </script>

    <script>
        $('#addNewItemButton').click(function() {
            $('#addNewItemModal').modal('show');
        });

        $('#addNewItemForm').on('submit', function(e) {
            e.preventDefault();

            // Get the price value and clean it
            let priceValue = $('#formAddItemPrice').val();
            // Remove currency symbol, commas and spaces
            priceValue = priceValue.replace(/[₱,\s]/g, '');
            // Convert to number
            priceValue = parseFloat(priceValue);

            $.ajax({
                url: "{{ route('addItem') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    item_code: $('#formAddItemCode').val(),
                    item_name: $('#formAddItemName').val(),
                    item_category_id: $('#formAddItemCategory').val(),
                    item_unit_of_measure: $('#formAddItemUnitOfMeasure').val(),
                    item_description: $('#formAddItemDescription').val(),
                    is_available: $('#formAddItemIsAvailable').val(),
                    is_psdbm: $('#formAddItemIsPSDBM').val(),
                    item_price: priceValue, // Use the cleaned price value
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewItemForm')[0].reset();
                    $('#addNewItemModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshItemTable();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
                    });
                    console.error(xhr.responseText);
                }
            });
        });

        function editItem(id, name, code, item_category_id, unit_of_measure, description, is_available, is_psdbm, price) {


            // Set form values
            $('#formEditItemID').val(id);
            $('#formEditItemName').val(name);
            $('#formEditItemCode').val(code);
            $('#formEditItemDescription').val(description);
            $('#formEditItemUnitOfMeasure').val(unit_of_measure);
            $('#formEditItemIsAvailable').val(is_available);
            $('#formEditItemIsPSDBM').val(is_psdbm);
            $('#formEditItemCategory').val(item_category_id);
            $('#formEditItemPrice').val(price);
            // Show modal
            $('#editItemModal').modal('show');
        }

        // Handle form submission
        $('#editItemForm').on('submit', function(e) {
            e.preventDefault();

            // Get the price value and clean it
            let priceValue = $('#formEditItemPrice').val();
            // Remove currency symbol, commas and spaces
            priceValue = priceValue.replace(/[₱,\s]/g, '');
            // Convert to number
            priceValue = parseFloat(priceValue);

            $.ajax({
                url: "{{ route('updateItem') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#formEditItemID').val(),
                    item_name: $('#formEditItemName').val(),
                    item_code: $('#formEditItemCode').val(),
                    item_category_id: $('#formEditItemCategory').val(),
                    item_description: $('#formEditItemDescription').val(),
                    item_unit_of_measure: $('#formEditItemUnitOfMeasure').val(),
                    is_available: $('#formEditItemIsAvailable').val(),
                    is_psdbm: $('#formEditItemIsPSDBM').val(),
                    item_price: priceValue,
                },
                dataType: 'json',
                success: function(response) {
                    $('#editItemModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshItemTable();
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
        function deleteItem(itemId, itemName) {
            Swal.fire({
                title: 'Are you sure you want to delete this item?',
                text: `${itemName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('deleteItem') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            item_id: itemId, // Send the ID via POST data
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                refreshItemTable();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshItemTable();
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>
@endsection
