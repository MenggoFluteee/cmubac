@extends('layouts.app')

@section('title', 'PPMPs')

@section('content')
    <div class="container-fluid">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">List of Project Procurement Management Plan</h1>
            </div>
            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center">
                    <form class="" method="GET">
                        <label for="filterByYear" class="me-2">Select Year:</label>
                        <select name="filterByYear" id="filterByYear" class="form-select" onchange="this.form.submit()">
                            @foreach ($availableYears as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="card">
                    <div class="card-header text-end">
                        <button type="button" class="btn btn-success" id="addNewPPMPButton"><i data-lucide="plus"
                                class="lucide lucide-plus"></i> Create new PPMP</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-hover" id="ppmpsTable">
                            <thead>
                                <tr>
                                    <th style="width: 15%">PPMP Code</th>
                                    <th style="width: 30%">Account Code</th>
                                    <th style="width: 15%">Fund Source</th>
                                    <th>Submitted</th>
                                    <th>Approval Status</th>
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

    <div class="modal fade" id="addNewPPMPModal" tabindex="-1" role="dialog" aria-labelledby="addNewPPMPModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create PPMP Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewPPMPForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Account Code</label>
                                <select name="addNewPPMPAccountCode" id="addNewPPMPAccountCode" class="form-select">
                                    @if (count($budgetAllocations) > 0)
                                        <option value="" disabled selected>Select an account code with budget</option>
                                        @foreach ($budgetAllocations as $allocation)
                                            <option value="{{ $allocation->id }}">
                                                {{ $allocation->accountCode->account_name }} |
                                                {{ Number::currency($allocation->amount, 'PHP') }} |
                                                {{ $allocation->wholeBudget->source_of_fund }} |
                                                {{ $allocation->wholeBudget->year }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>There is currently no budget available for
                                            this year</option>
                                    @endif
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

    <script>
        function refreshPPMPsTable() {
            showLoadingIndicator();

            $.ajax({
                url: "{{ route('endUserFetchPPMPs') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    yearSelect: $('#filterByYear').val(),
                },
                success: function(data) {
                    hideLoadingIndicator();

                    console.log(data); // Check fetched data in console

                    var table = $('#ppmpsTable').DataTable();
                    table.clear(); // Clear existing table data

                    data.forEach(function(ppmp) {
                        let submissionStatus;
                        if (ppmp.is_submitted == 0) {
                            submissionStatus = '<span class="badge bg-warning">Draft</span>';
                        } else {
                            let formattedDate = new Date(ppmp.updated_at).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });

                            submissionStatus =
                                `<span class="badge bg-success">Submitted</span> <small class="text-muted">${formattedDate}</small>`;
                        }


                        let approvalStatus;
                        if (ppmp.approval_status == 0) {
                            approvalStatus = '<span class="badge bg-warning">Pending</span>';
                        } else if (ppmp.approval_status == 1) {
                            approvalStatus =
                                '<span class="badge bg-success">Approved</span> <small class="text-muted">Ready for PR</small>';
                        } else {
                            approvalStatus = '<span class="badge bg-danger">Not Approved</span>';
                        }

                        // Base action buttons that are always shown
                        var actionButtons = `
            <button type="button" class="btn btn-sm btn-primary" title="View PPMP" onclick="viewPPMP(${ppmp.id})">
                <i class="fas fa-eye"></i> 
            </button>
            <button type="button" class="btn btn-sm btn-danger" title="Delete PPMP" onclick="deletePPMP(${ppmp.id}, '${ppmp.ppmp_code}')">
                <i class="fas fa-trash"></i>
            </button>
        `;



                        table.row.add([
                            ppmp.ppmp_code,
                            ppmp.budget_allocation.account_code.account_name,
                            ppmp.budget_allocation.whole_budget.source_of_fund,
                            submissionStatus,
                            approvalStatus,
                            actionButtons
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
            $('#ppmpsTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#ppmpsTable_wrapper .col-md-6:eq(0)');



            refreshPPMPsTable();

        });
    </script>

    <script>
        function viewPPMP(id) {
            window.location.href = `end-user-ppmp-details/${id}`;
        }

        function deletePPMP(id, ppmpCode) {
            Swal.fire({
                title: 'Are you sure you want to delete this PPMP?',
                text: `${ppmpCode}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('endUserDeletePPMP') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            ppmpId: id, // Send the ID via POST data
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                    refreshPPMPsTable();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }

                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {
                                refreshPPMPsTable();
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }

        $('#addNewPPMPButton').click(function() {
            $('#addNewPPMPModal').modal('show');
        });

        $('#addNewPPMPForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('endUserAddNewPPMP') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    formAddPPMPAccountCode: $('#addNewPPMPAccountCode').val(),
                },
                dataType: 'json',
                success: function(response) {
                    $('#addNewPPMPForm')[0].reset();
                    $('#addNewPPMPModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        refreshPPMPsTable();
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
