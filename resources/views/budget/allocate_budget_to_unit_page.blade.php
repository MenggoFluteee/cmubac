@extends('layouts.app')

@section('title', 'Account Codes')

@section('content')
    <div class="container-fluid">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Allocate Budget for {{ $collegeOfficeUnit->college_office_unit_name }}</h1>
            </div>

            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center">
                    <form method="GET">
                        <label for="filterByYear" class="me-2">Select Year:</label>
                        <select name="filterByYear" id="filterByYear" class="form-select" onchange="this.form.submit()">
                            @foreach ($years as $yearOption)
                                <option value="{{ $yearOption->year }}" {{ $yearOption->year == $year ? 'selected' : '' }}>
                                    {{ $yearOption->year }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>



        </div>

        <div class="container-fluid p-0">

            <div class="row">
                <div class="row" style="height: calc(100vh - 250px);">
                    <!-- Account codes sidebar with scroll -->
                    <div class="col-md-3 col-xl-2" style="height: 100%; overflow: hidden;">
                        <div class="card h-100 d-flex flex-column">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Account Codes</h5>
                            </div>
                            <div class="list-group list-group-flush flex-grow-1" role="tablist" style="overflow-y: auto;">
                                <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                    href="#profile" role="tab" aria-selected="false" tabindex="-1">
                                    Profile
                                </a>
                                @foreach ($accountCodes as $code)
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                        href="#listGroup{{ $code->id }}" role="tab" aria-selected="false"
                                        data-account-id="{{ $code->id }}" data-account-name="{{ $code->account_name }}">
                                        {{ $code->account_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-xl-10" style="height: 100%; overflow: hidden;">
                        <div class="tab-content h-100">
                            {{-- Profile Tab Content --}}
                            <div class="tab-pane fade active show" id="profile" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 d-flex justify-content-center flex-column">
                                                <div class="text-center">
                                                    <div class="mb-1">
                                                        <h1>{{ $collegeOfficeUnit->college_office_unit_name }}
                                                        </h1>
                                                    </div>
                                                    <h4 class="text-muted">{{ $collegeOfficeUnit->category->category_name }}
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <img alt="CMU Logo" src="{{ asset('images/cmulogo.png') }}"
                                                        class="rounded-circle img-responsive mt-2" width="150"
                                                        height="150">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="height:100%; overflow: hidden;">
                                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                        <div class="col-12 mb-3">
                                            <div class="row">

                                                <div class="col-auto ms-auto">
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn btn-primary btn-sm">Export to PDF <i
                                                                class="fas fa-file-pdf"></i></button>
                                                        <button class="btn btn-info btn-sm">Export to Excel <i
                                                                class="fas fa-file-excel"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="exportContainer" class="exportContainer">
                                            <table class="table table-responsive table-bordered table-hover">
                                                <thead>
                                                    <tr style="background-color: rgba(2, 104, 30, 0.3)">
                                                        <th>Commodity Group</th>
                                                        <th>General Fund</th>
                                                        <th>Trust Fund</th>
                                                        <th>Special Trust Fund</th>
                                                        <th>RGMO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($accountCodes as $code)
                                                        @php
                                                            $allocations = $code->budgetAllocations->groupBy(function (
                                                                $allocation,
                                                            ) {
                                                                return $allocation->wholeBudget->source_of_fund ?? null;
                                                            });
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $code->account_name }}</td>
                                                            <td style="text-align: right">
                                                                {{ Number::currency($allocations->get('General Fund')?->first()?->amount ?? 0, 'PHP') }}
                                                            </td>
                                                            <td style="text-align: right">
                                                                {{ Number::currency($allocations->get('Trust Fund')?->first()?->amount ?? 0, 'PHP') }}
                                                            </td>
                                                            <td style="text-align: right">
                                                                {{ Number::currency($allocations->get('Special Trust Fund')?->first()?->amount ?? 0, 'PHP') }}
                                                            </td>
                                                            <td style="text-align: right">
                                                                {{ Number::currency($allocations->get('RGMO')?->first()?->amount ?? 0, 'PHP') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @foreach ($accountCodes as $code)
                                <div class="tab-pane fade" id="listGroup{{ $code->id }}" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h5 class="card-title">{{ $code->account_name }}</h5>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button type="button" class="btn btn-success allocateNewBudgetButton"
                                                        data-account-id="{{ $code->id }}"
                                                        data-account-name="{{ $code->account_name }}"
                                                        data-bs-toggle="modal" data-bs-target="#allocateBudgetModal">
                                                        <i data-lucide="plus"></i> Allocate Budget
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table" id="budgetTable{{ $code->id }}">
                                                <thead>
                                                    <tr>
                                                        <th>Amount</th>
                                                        <th>Year</th>
                                                        <th>Source of Fund</th>
                                                        <th>Budget Type</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Budget Allocation Modal -->
        <div class="modal fade" id="allocateBudgetModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="budgetAllocationForm">
                        @csrf
                        <input type="hidden" name="account_code_id" id="selectedAccountId">
                        <input type="hidden" name="allocation_id" id="allocationId">
                        <input type="hidden" class="form-control" name="college_office_unit_id"
                            id="college_office_unit_id" value="{{ $collegeOfficeUnit->id }}">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Allocate Budget</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" name="budgetAmount" id="budgetAmount"
                                    required>
                                <script>
                                    $(document).ready(function() {
                                        $('#budgetAmount').inputmask({
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
                            <div class="mb-3">
                                <label class="form-label">Select Budget</label>
                                <select class="form-select" id="whole_budget_id" name="whole_budget_id">
                                    <option disabled selected>Select a budget</option>
                                    @foreach ($yearlyBudget as $budget)
                                        <option value="{{ $budget->id }}">{{ $budget->source_of_fund }} of AY
                                            {{ $budget->year }} -
                                            {{ $budget->amount ? Number::currency($budget->amount, 'PHP') : 0.0 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Budget Type</label>
                                <select class="form-select" name="budget_type" id="budget_type" required>
                                    <option value="" selected disabled>Select budget type</option>
                                    <option value="Main">Main</option>
                                    <option value="Supplimentary">Supplimentary</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Budget</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- EDIT BUDGET MODAL --}}
        <div class="modal fade " id="editBudgetAllocationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editBudgetAllocationForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Edit Budget Allocation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="editBudgetAllocationId" name="editBudgetAllocationId" hidden>
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" name="editBudgetAllocationAmount"
                                    id="editBudgetAllocationAmount" required>
                                <script>
                                    $(document).ready(function() {
                                        $('#editBudgetAllocationAmount').inputmask({
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
                            <div class="mb-3">
                                <label class="form-label">Select Budget</label>
                                <select class="form-select" id="editBudgetAllocationWholeBudget"
                                    name="editBudgetAllocationWholeBudget">
                                    <option disabled selected>Select a budget</option>
                                    @foreach ($yearlyBudget as $budget)
                                        <option value="{{ $budget->id }}">{{ $budget->source_of_fund }} of AY
                                            {{ $budget->year }} -
                                            {{ $budget->amount ? Number::currency($budget->amount, 'PHP') : 0.0 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Budget Type</label>
                                <select class="form-select" name="editBudgetAllocationBudgetType"
                                    id="editBudgetAllocationBudgetType" required>
                                    <option value="" selected disabled>Select budget type</option>
                                    <option value="Main">Main</option>
                                    <option value="Supplimentary">Supplimentary</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Budget</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('allocateBudgetModal');
                const form = document.getElementById('budgetAllocationForm');
                const yearSelect = document.getElementById('filterByYear');
                let tables = {};

                // Initialize DataTables with empty data
                @foreach ($accountCodes as $code)
                    tables['table{{ $code->id }}'] = $(`#budgetTable{{ $code->id }}`).DataTable({
                        order: [
                            [1, 'desc']
                        ],
                        columns: [{
                                data: null,
                                render: function(data) {
                                    return new Intl.NumberFormat('en-PH', {
                                        style: 'currency',
                                        currency: 'PHP'
                                    }).format(data.amount);
                                }
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return data.whole_budget ? data.whole_budget.year : '';
                                }
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return data.whole_budget ? data.whole_budget.source_of_fund : '';
                                }
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return data.whole_budget ? data.whole_budget.type_of_budget : '';
                                }
                            },
                            {
                                data: null,
                                orderable: false,
                                render: function(data) {
                                    return `
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-success edit-budget me-1" 
            data-id="${data.id}" 
            data-amount="${data.amount}"
            data-year="${data.whole_budget ? data.whole_budget.year : ''}"
            data-source="${data.whole_budget ? data.whole_budget.id : ''}"
            data-type="${data.whole_budget ? data.whole_budget.type_of_budget : ''}">
            <i class="fas fa-edit"></i>
        </button>
                        <button type="button" class="btn btn-sm btn-danger delete-budget" data-id="${data.id}" data-year="${data.whole_budget.year}" data-account-code="{{ $code->account_name }}" data-amount="${data.amount}" data-college-office-unit="{{ $collegeOfficeUnit->college_office_unit_name }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>`;
                                },

                            },
                        ]
                    });
                @endforeach



                // Function to filter budget options based on year
                function filterWholeBudgetOptions() {
                    const selectedYear = document.getElementById('filterByYear').value;
                    const budgetSelect = document.getElementById('whole_budget_id');
                    const options = budgetSelect.querySelectorAll('option');
                    let hasValidOption = false;

                    options.forEach(option => {
                        if (option.disabled) {
                            option.style.display = ''; // Keep disabled option visible
                            return;
                        }

                        // Extract year from the option text (e.g., "General Fund of AY 2024 - ₱1,000.00")
                        const match = option.text.match(/AY (\d{4})/);
                        const optionYear = match ? match[1] : null;

                        if (optionYear === selectedYear) {
                            option.style.display = '';
                            hasValidOption = true;
                        } else {
                            option.style.display = 'none';

                            // If this hidden option was selected, reset selection
                            if (option.selected) {
                                budgetSelect.value = '';
                            }
                        }
                    });

                    // If no valid options exist for the selected year, reset the selection
                    if (!hasValidOption) {
                        budgetSelect.value = '';
                    }
                }




                // Function to refresh specific table
                function refreshTable(accountId, year) {
                    if (!accountId) return;

                    showLoadingIndicator();

                    $.ajax({
                        url: "{{ route('budgetOfficeFetchBudgetAllocationsV2') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            account_code_id: accountId,
                            college_office_unit_id: {{ $collegeOfficeUnit->id }},
                            year: year
                        },
                        success: function(response) {
                            const table = tables[`table${accountId}`];
                            if (table) {
                                table.clear();
                                table.rows.add(response.data).draw();
                            }
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to fetch budget allocations.'
                            });
                        },
                        complete: function() {
                            hideLoadingIndicator();
                        }
                    });
                }

                function refreshExportTable(year) {
                    showLoadingIndicator();

                    $.ajax({
                        url: "{{ route('budgetOfficeFetchBudgetAllocationsV2') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            account_code_id: accountId,
                            college_office_unit_id: {{ $collegeOfficeUnit->id }},
                            year: year
                        },
                        success: function(response) {
                            const table = tables[`table${accountId}`];
                            if (table) {
                                table.clear();
                                table.rows.add(response.data).draw();
                            }
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to fetch budget allocations.'
                            });
                        },
                        complete: function() {
                            hideLoadingIndicator();
                        }
                    });
                }

                // Handle tab changes
                $('a[data-bs-toggle="list"]').on('shown.bs.tab', function(e) {
                    const accountId = $(e.target).data('account-id');
                    const year = yearSelect.value;
                    if (accountId) {
                        refreshTable(accountId, year);
                        console.log('filtering data from account ID ' + accountId + ' using the year ' + year);

                    }
                });

                // Handle year changes
                $('#filterByYear').on('change', function() {
                    const selectedYear = $(this).val();

                    // Filter budget options
                    filterWholeBudgetOptions();

                    // Refresh current table if on an account tab
                    const activeTab = $('.list-group-item.active');
                    const accountId = activeTab.data('account-id');
                    if (accountId) {
                        refreshTable(accountId, selectedYear);
                        console.log('filtering data from account ID ' + accountId + ' using the year ' +
                            selectedYear);
                    }
                });

                // Handle allocate budget button click
                $('.allocateNewBudgetButton').on('click', function() {
                    const accountId = $(this).data('account-id');
                    const accountName = $(this).data('account-name');

                    $('#selectedAccountId').val(accountId);
                    $('#allocationId').val('');
                    $('#modalTitle').text(`Allocate ${accountName} Budget`);
                    form.reset();

                    // Filter budget options when opening modal
                    filterWholeBudgetOptions();
                });

                // Handle form submission
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let amount = $('#budgetAmount').val();
                    amount = amount.replace(/[₱,\s]/g, '');
                    amount = parseFloat(amount);

                    $.ajax({
                        url: "{{ route('allocateBudgetToCollegeOfficeUnit') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            collegeOfficeUnitId: $('#college_office_unit_id').val(),
                            accountCodeId: $('#selectedAccountId').val(),
                            wholeBudgetId: $('#whole_budget_id').val(),
                            budgetAmount: amount,
                            budgetType: $('select[name="budget_type"]').val()
                        },
                        dataType: 'json',
                        success: function(response) {
                            form.reset();
                            $('#whole_budget_id').val('').trigger('change');
                            $('#allocateBudgetModal').modal('hide');

                            // Refresh the current table
                            const activeTab = $('a[data-bs-toggle="list"].active');
                            const accountId = activeTab.data('account-id');
                            98
                            if (accountId) {
                                refreshTable(accountId, yearSelect.value);
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message ||
                                    'Budget allocation saved successfully!'
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong while saving the budget allocation.'
                            });
                            console.error(xhr.responseText);
                        }
                    });
                });

                $(document).on('click', '.delete-budget', function() {
                    const id = $(this).data('id');
                    const year = $(this).data('year');
                    const amount = $(this).data('amount');
                    const accountCode = $(this).data('accountCode');
                    const collegeOfficeUnit = $(this).data('collegeOfficeUnit');

                    // Format the amount as PHP currency
                    const formattedAmount = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP'
                    }).format(amount);

                    Swal.fire({
                        title: `Are you sure you want to delete this budget allocation?`,
                        text: `Budget amount of ${formattedAmount} allocated to ${collegeOfficeUnit}: ${accountCode}`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#02681e',
                        cancelButtonColor: 'd33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('budgetOfficeDeleteBudgetAllocation') }}",
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    budget_allocation_id: id
                                },
                                success: function(response) {
                                    Swal.fire('Deleted!', `${response.message}`, 'success')
                                        .then(
                                            () => {
                                                const activeTab = $(
                                                    'a[data-bs-toggle="list"].active');
                                                const accountId = activeTab.data(
                                                    'account-id');
                                                if (accountId) {
                                                    refreshTable(accountId, yearSelect
                                                        .value);
                                                }
                                            });
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire('Error!', 'Something went wrong.', 'error')
                                        .then(
                                            () => {
                                                const activeTab = $(
                                                    'a[data-bs-toggle="list"].active');
                                                const accountId = activeTab.data(
                                                    'account-id');
                                                if (accountId) {
                                                    refreshTable(accountId, yearSelect
                                                        .value);
                                                }
                                            });
                                    console.error(xhr.responseText);
                                },
                            });
                        }
                    });
                });


                // Handle edit button click
                $(document).on('click', '.edit-budget', function() {
                    const id = $(this).data('id');
                    const amount = $(this).data('amount');
                    const wholeBudgetId = $(this).data('source');
                    const budgetType = $(this).data('type');

                    $('#editBudgetAllocationId').val(id);
                    $('#editBudgetAllocationAmount').val(amount);
                    $('#editBudgetAllocationWholeBudget').val(wholeBudgetId);
                    $('#editBudgetAllocationBudgetType').val(budgetType);

                    // Show the modal
                    $('#editBudgetAllocationModal').modal('show');
                });

                $(document).on('submit', '#editBudgetAllocationForm', function(e) {
                    e.preventDefault();

                    // Retrieve the updated values
                    let amount = $('#editBudgetAllocationAmount').val();
                    amount = amount.replace(/[₱,\s]/g, '');
                    amount = parseFloat(amount);

                    let budgetAllocationId = $('#editBudgetAllocationId').val();
                    let wholeBudgetId = $('#editBudgetAllocationWholeBudget').val();
                    let budgetType = $('#editBudgetAllocationBudgetType').val();

                    $.ajax({
                        url: "{{ route('budgetOfficeEditBudgetAllocation') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            budget_allocation_id: budgetAllocationId,
                            whole_budget_id: wholeBudgetId,
                            budget_amount: amount,
                            budget_type: budgetType,
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#editBudgetAllocationModal').modal('hide');
                            Swal.fire('Updated!', `${response.message}`, 'success')
                                .then(
                                    () => {
                                        const activeTab = $(
                                            'a[data-bs-toggle="list"].active');
                                        const accountId = activeTab.data(
                                            'account-id');
                                        if (accountId) {
                                            refreshTable(accountId, yearSelect
                                                .value);
                                        }
                                    });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong while saving the budget allocation.'
                            });
                            console.error(xhr.responseText);
                        }
                    });
                });



            });
        </script>


    @endsection
