@extends('layouts.app')

@section('title', 'Budget Allocation')

@section('content')

    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Budget Allocations</h1>
            </div>
            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center">
                    <label for="filterTableByYear" class="me-2 input-label">Select Year:</label>
                    <select class="form-select select2" style="width: auto" id="filterTableByYear" name="filterTableByYear">
                        <option value="" disabled>Select Year</option>
                        <script>
                            const currentYear = new Date().getFullYear(); // Get the current year
                            for (let i = 1900; i <= 2100; i++) {
                                document.write(
                                    `<option value="${i}" ${i === currentYear ? "selected" : ""}>${i}</option>`
                                );
                            }
                        </script>
                    </select>
                </div>
            </div>


        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="allocateNewBudgetButton"><i
                                    data-lucide="plus" class="lucide lucide-plus"> </i> Allocate Budget</button>
                        </div>
                        <div class="card-body">
                            <table id="budgetAllocationTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>College / Office / Unit</th>
                                        <th>Amount</th>
                                        <th>Source of Fund</th>
                                        <th>Type of Fund</th>
                                        <th>Account Code</th>
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
    <div class="modal fade" id="allocateNewBudgetModal" tabindex="-1" role="dialog"
        aria-labelledby="allocateNewBudgetModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Allocate Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="allocateNewBudgetForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">
                        <div class="col-12 mb-3">
                            <label class="form-label">Select College / Office / Unit</label>
                            <select class="form-select select2" style="width: 100%" name="formSelectCollegeOfficeUnit"
                                id="formSelectCollegeOfficeUnit" required>
                                <option selected disabled></option>
                                @foreach ($collegeOfficeUnits as $collegeOfficeUnit)
                                    <option value="{{ $collegeOfficeUnit->id }}">
                                        {{ $collegeOfficeUnit->college_office_unit_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12 mb-3">
                            <label class="form-label">Select Budget</label>
                            <select class="form-select select2" style="width: 100%" id="formSelectWholeBudget"
                                name="formSelectWholeBudget">
                                <option disabled selected></option>
                                @foreach ($yearlyBudget as $budget)
                                    <option value="{{ $budget->id }}">{{ $budget->source_of_fund }} of AY
                                        {{ $budget->year }} -
                                        {{ $budget->amount ? Number::currency($budget->amount, 'PHP') : 0.0 }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Select Account Code</label>
                            <select class="form-select select2" style="width: 100%" id="formSelectAccountCode"
                                name="formSelectAccountCode">
                                <option disabled selected></option>
                                @foreach ($accountCodes as $code)
                                    <option value="{{ $code->id }}">{{ $code->account_code }} |
                                        {{ $code->account_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Enter amount</label>
                            <input class="form-control form-control-lg" type="text" id="formAddBudgetAllocationAmount"
                                name="formAddBudgetAllocationAmount" placeholder="Please enter the amount">
                            <script>
                                $(document).ready(function() {
                                    $('#formAddBudgetAllocationAmount').inputmask({
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

    <div class="modal fade" id="viewBudgetAllocationModal" tabindex="-1" role="dialog"
        aria-labelledby="viewBudgetAllocationModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Allocated Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-4 text-start">
                                    <h3 class="card-title fw-bolder" id="selectedCollegeOfficeUnitTitle">Basic Table</h5>
                                        <h6 class="card-subtitle text-muted" id="selectCollegeOfficeUnitSourceOfFund">
                                            Using the
                                            most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
                                </div>
                                <div class="col-4 text-center">
                                    <h6 class="card-subtitle fw-bold" id="selectCollegeOfficeUnitWholeAmount">
                                        ₱20,000,000.00</h6>
                                </div>
                                <div class="col-4 text-end">
                                    <h6 class="card-subtitle fw-bold" id="selectCollegeOfficeUnitYear">Year</h6>
                                </div>
                            </div>
                        </div>

                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 60%">Name</th>
                                    <th style="width: 40%">Allocate Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accountCodes as $index => $code)
                                    <tr>
                                        <td>{{ $code->account_name }}</td>
                                        <td>
                                            <input type="text" class="form-control allocate-budget-field"
                                                placeholder="Place the amount you want to allocate here"
                                                name="allocateBudgetField[{{ $index }}]"
                                                id="allocateBudgetField_{{ $index }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="card-footer">
                            <div class="text-center">
                                <h6 class="card-subtitle fw-bold  mt-3 mb-3" style="font-size: 16px"
                                    id="budgetAllocationBudgetAmount">₱20,000,000.00</h6>
                                <h6 class="card-subtitle" style="width: auto" id="budgetAllocationBudgetBalance">Budget
                                    Balance</h6>
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
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Function for getting the default fetch of all the account codes
        function refreshBudgetAllocationTable(selectedYear = null) {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('budgetOfficeFetchBudgetAllocations') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    year: selectedYear, // Include the selected year in the request
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#budgetAllocationTable').DataTable();
                    table.clear();

                    data.forEach(function(budgetAllocation) {
                        var editButton =
                            `<button type="button" class="btn btn-sm btn-success me-1" 
                    title="View Information" onclick="viewBudgetAllocation(${budgetAllocation.id}, 
                                '${budgetAllocation.college_office_unit_name.replace(/'/g, "\\'")}','${budgetAllocation.sourceOfFund.replace(/'/g, "\\'")}','${budgetAllocation.year.replace(/'/g, "\\'")}',)"><i class="fas fa-info-circle"></i></button>`;

                        var deleteButton = `<button type="button" class="btn btn-sm btn-danger" 
                    title="Delete"><i class="fas fa-trash"></i></button>`;

                        table.row.add([
                            budgetAllocation.college_office_unit_name,
                            `<div class="text-end">${budgetAllocation.budgetAmount}</div>`,
                            budgetAllocation.sourceOfFund,
                            budgetAllocation.typeOfFund,
                            budgetAllocation.accountCode,
                            budgetAllocation.year,
                            editButton + deleteButton
                        ]);
                    });

                    table.draw();
                },
                error: function(xhr, status, error) {
                    hideLoadingIndicator();
                    console.error("Error:", xhr.responseText);
                }
            });
        }



        $(document).ready(function() {
            $('#budgetAllocationTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#budgetAllocationTable_wrapper .col-md-6:eq(0)');

            refreshBudgetAllocationTable();

            $('#filterTableByYear').on('change', function() {
                const selectedYear = $(this).val();
                refreshBudgetAllocationTable(selectedYear); // Pass the selected year to the function
            });

            // INPUT MASK OF THE ALLOCATION MODAL
            $('.allocate-budget-field').inputmask({
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

    <script>
        $('#allocateNewBudgetButton').click(function() {
            $('#allocateNewBudgetModal').modal('show');
        });
        $('#formSelectWholeBudget').change(function() {
            $('#formAddBudgetAllocationAmount').val(''); // Clear the value of the input field
        });

        $('#allocateNewBudgetForm').on('submit', function(e) {
            e.preventDefault();


            // Get the price value and clean it
            let budgetAllocationAmount = $('#formAddBudgetAllocationAmount').val();
            // Remove currency symbol, commas and spaces
            budgetAllocationAmount = budgetAllocationAmount.replace(/[₱,\s]/g, '');
            // Convert to number
            budgetAllocationAmount = parseFloat(budgetAllocationAmount);



            $.ajax({
                url: "{{ route('addNewBudgetAllocation') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formSelectCollegeOfficeUnit: $('#formSelectCollegeOfficeUnit').val(),
                    formSelectWholeBudget: $('#formSelectWholeBudget').val(),
                    formSelectAccountCode: $('#formSelectAccountCode').val(),
                    formAddBudgetAllocationAmount: budgetAllocationAmount,
                },
                dataType: 'json',
                success: function(response) {
                    // Reset the form
                    $('#allocateNewBudgetForm')[0].reset();

                    // Reset the Select2 fields
                    $('#formSelectCollegeOfficeUnit').val('').trigger('change');
                    $('#formSelectWholeBudget').val('').trigger('change');
                    $('#formSelectAccountCode').val('').trigger('change');

                    // Hide the modal
                    $('#allocateNewBudgetModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshBudgetAllocationTable();
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

        function viewBudgetAllocation(id, collegeOfficeUnitName, sourceOfFund, year) {
            $('#selectedCollegeOfficeUnitTitle').text(collegeOfficeUnitName);
            $('#selectCollegeOfficeUnitSourceOfFund').text(sourceOfFund);
            $('#selectCollegeOfficeUnitYear').text(year);
            $('#viewBudgetAllocationModal').modal('show');
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
                        refreshbudgetAllocationTable();
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
                                refreshbudgetAllocationTable();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshbudgetAllocationTable();
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
