@extends('layouts.app')

@section('title', 'Yearly Budget')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Yearly Budget</h1>
            </div>


        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="addNewYearlyBudgetButton"><i
                                    data-lucide="plus" class="lucide lucide-plus"> </i> Add
                                yearly budget</button>
                        </div>
                        <div class="card-body">
                            <table id="yearlyBudgetTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>Source of Fund</th>
                                        <th>Amount</th>
                                        <th>Type of Fund</th>
                                        <th>For the Year</th>
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
    <div class="modal fade" id="addNewYealyBudgetModal" tabindex="-1" role="dialog"
        aria-labelledby="addNewYealyBudgetModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Yearly Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewYearlyBudgetForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">



                        <div class="col-12 mb-3">
                            <label class="form-label">Budget for the year</label>
                            <select class="form-select select2" style="width: 100%" id="formAddYearlyBudgetYear"
                                name="formAddYearlyBudgetYear">
                                <option value="" disabled selected>Select Year</option>
                                <script>
                                    for (let i = 1900; i <= 2100; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Source of Fund</label>
                            <select class="form-select" name="formAddYearlyBudgetSourceOfFund"
                                id="formAddYearlyBudgetSourceOfFund" required>
                                <option value="">Select source of fund</option>
                                <option value="General Fund">General Fund</option>
                                <option value="Trust Fund">Trust Fund</option>
                                <option value="Special Trust Fund">Special Trust Fund</option>
                                <option value="RGMO">RGMO</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Budget Type</label>
                            <select class="form-select" name="formAddYearlyBudgetType" id="formAddYearlyBudgetType"
                                required>
                                <option value="">Select type</option>
                                <option value="Main">Main</option>
                                <option value="Supplimentary">Supplimentary</option>

                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Budget Amount</label>
                            <input type="text" class="form-control form-control-lg" id="formAddYearlyBudgetAmount"
                                name="formAddYearlyBudgetAmount" required placeholder="Enter budget">
                            <script>
                                $(document).ready(function() {
                                    $('#formAddYearlyBudgetAmount').inputmask({
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


    <div class="modal fade" id="editYealyBudgetModal" tabindex="-1" role="dialog" aria-labelledby="editYealyBudgetModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Yearly Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editYearlyBudgetForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <input type="text" id="formEditYearlyBudgetId" name="formEditYearlyBudgetId" hidden>

                        <div class="col-12 mb-3">
                            <label class="form-label">Budget for the year</label>
                            <select class="form-select" id="formEditYearlyBudgetYear" name="formEditYearlyBudgetYear">
                                <option value="" disabled selected>Select Year</option>
                                <script>
                                    for (let i = 1900; i <= 2100; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Source of Fund</label>
                            <select class="form-select" name="formEditYearlyBudgetSourceOfFund"
                                id="formEditYearlyBudgetSourceOfFund" required>
                                <option value="">Select source of fund</option>
                                <option value="General Fund">General Fund</option>
                                <option value="Trust Fund">Trust Fund</option>
                                <option value="Special Trust Fund">Special Trust Fund</option>
                                <option value="RGMO">RGMO</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Budget Type</label>
                            <select class="form-select" name="formEditYearlyBudgetType" id="formEditYearlyBudgetType"
                                required>
                                <option value="">Select type</option>
                                <option value="Main">Main</option>
                                <option value="Supplimentary">Supplimentary</option>

                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Budget Amount</label>
                            <input type="text" class="form-control" id="formEditYearlyBudgetAmount"
                                name="formEditYearlyBudgetAmount" required placeholder="Enter budget">
                            <script>
                                $(document).ready(function() {
                                    $('#formEditYearlyBudgetAmount').inputmask({
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
        // Function for getting the default fetch of all the account codes
        function refreshYearlyBudgetTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('fetchYearlyBudget') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#yearlyBudgetTable').DataTable();
                    table.clear();
                    data.forEach(function(yearlyBudget) {
                        var editButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="editYearlyBudget(
                                ${yearlyBudget.id}, 
                                '${yearlyBudget.amount.replace(/'/g, "\\'")}',
                                ${yearlyBudget.year},
                                '${yearlyBudget.sourceOfFund.replace(/'/g, "\\'")}',
                                '${yearlyBudget.typeOfBudget.replace(/'/g, "\\'")}',
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                            onclick="deleteYearlyBudget(${yearlyBudget.id},  '${yearlyBudget.year}',  '${yearlyBudget.amount.replace(/'/g, "\\'")}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>`;

                        table.row.add([
                            yearlyBudget.sourceOfFund,
                            `<div class="text-end">${yearlyBudget.amount}</div>`,
                            yearlyBudget.typeOfBudget,
                            yearlyBudget.year,
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
            $('#yearlyBudgetTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#yearlyBudgetTable_wrapper .col-md-6:eq(0)');



            refreshYearlyBudgetTable();

        });
    </script>

    <script>
        $('#addNewYearlyBudgetButton').click(function() {
            $('#addNewYealyBudgetModal').modal('show');
        });

        $('#addNewYearlyBudgetForm').on('submit', function(e) {
            e.preventDefault();


            // Get the price value and clean it
            let yearAmount = $('#formAddYearlyBudgetAmount').val();
            // Remove currency symbol, commas and spaces
            yearAmount = yearAmount.replace(/[₱,\s]/g, '');
            // Convert to number
            yearAmount = parseFloat(yearAmount);



            $.ajax({
                url: "{{ route('addNewYearlyBudget') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formAddYearlyBudgetYear: $('#formAddYearlyBudgetYear').val(),
                    formAddYearlyBudgetSourceOfFund: $('#formAddYearlyBudgetSourceOfFund').val(),
                    formAddYearlyBudgetType: $('#formAddYearlyBudgetType').val(),
                    formAddYearlyBudgetAmount: yearAmount,
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewYearlyBudgetForm')[0].reset();
                    $('#addNewYealyBudgetModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshYearlyBudgetTable();
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

        function editYearlyBudget(id, amount, year, sourceOfFund, typeOfBudget) {
            $('#formEditYearlyBudgetId').val(id);
            $('#formEditYearlyBudgetYear').val(year);
            $('#formEditYearlyBudgetSourceOfFund').val(sourceOfFund);
            $('#formEditYearlyBudgetType').val(typeOfBudget);
            $('#formEditYearlyBudgetAmount').val(amount);

            // Show modal
            $('#editYealyBudgetModal').modal('show');
        }

        // Handle form submission
        $('#editYearlyBudgetForm').on('submit', function(e) {
            e.preventDefault();

            // Get the price value and clean it
            let yearAmount = $('#formEditYearlyBudgetAmount').val();
            // Remove currency symbol, commas and spaces
            yearAmount = yearAmount.replace(/[₱,\s]/g, '');
            // Convert to number
            yearAmount = parseFloat(yearAmount);

            $.ajax({
                url: "{{ route('editYearlyBudget') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formEditYearlyBudgetId: $('#formEditYearlyBudgetId').val(),
                    formEditYearlyBudgetYear: $('#formEditYearlyBudgetYear').val(),
                    formEditYearlyBudgetSourceOfFund: $('#formEditYearlyBudgetSourceOfFund').val(),
                    formEditYearlyBudgetType: $('#formEditYearlyBudgetType').val(),
                    formEditYearlyBudgetAmount: yearAmount
                },
                dataType: 'json',
                success: function(response) {
                    $('#editYealyBudgetModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshYearlyBudgetTable();
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
        function deleteYearlyBudget(id, year, budget) {
            Swal.fire({
                title: `Are you sure you want to delete ${year} yearly budget?`,
                text: `Amount: ${budget} `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('deleteYearlyBudget') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            id: id, // Send the ID via POST data
                            amount: budget,
                            year: year,
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                refreshYearlyBudgetTable();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshYearlyBudgetTable();
                                g;
                                6
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>
@endsection
