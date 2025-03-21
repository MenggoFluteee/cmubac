@extends('layouts.app')

@section('title', 'Purchase Requestes')
@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Purchase Requests</h1>
            </div>



        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="createPurchaseRequestButton"><i
                                    data-lucide="plus" class="lucide lucide-plus"> </i> Create Purchase Request</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive w-100 table-hover" id="purchaseRequestsTable]">
                                <thead>
                                    <tr>
                                        <th>PR Code</th>
                                        <th>Account Code</th>
                                        <th>Fund Source</th>
                                        <th>Submission Status</th>
                                        <th>Approval Status</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseRequests as $pr)
                                        <tr>
                                            <td>{{ $pr->pr_code }}</td>
                                            <td>{{ $pr->ppmp->budgetAllocation->accountCode->account_name }}</td>
                                            <td>{{ $pr->ppmp->budgetAllocation->wholeBudget->source_of_fund }}</td>
                                            @if ($pr->is_submitted == 0)
                                                <td><span class="badge bg-warning">Draft</span></td>
                                            @elseif($pr->is_submitted == 1)
                                                <td><span class="badge bg-success">Submitted</span></td>
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($pr->approval_status == 0)
                                                <td><span class="badge bg-warning">Pending</span></td>
                                            @elseif($pr->approval_status == 1)
                                                <td><span class="badge bg-success">Approved</span></td>
                                            @elseif($pr->approval_status == 2)
                                                <td><span class="badge bg-danger">Disapproved</span></td>
                                            @else
                                                <td></td>
                                            @endif


                                            <td><button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                                            </td>
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
    <div class="modal fade" id="createNewPRModal" tabindex="-1" role="dialog" aria-labelledby="createNewPRModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewItemForm" action="{{ route('addItem') }}" method="POST">
                    @csrf

                    <div class="modal-body mx-3">
                        <div class="col-12 mb-3">
                            <label class="form-label">Select approved PPMP</label>
                            <select class="form-select select2" style="width: 100%" name="formSelectPPMPToPR"
                                id="formSelectPPMPToPR" required>
                                <option value="" selected @readonly(true) disabled>Select approved PPMP</option>
                                @foreach ($approvedPPMP as $ppmp)
                                    <option value="{{ $ppmp->id }}">{{ $ppmp->ppmp_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Purpose of Request</label>
                            <input type="text" class="form-control" id="">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Purpose of Request</label>
                            <textarea name="formPurposeOfPR" id="formPurposeOfPR" class="form-control"></textarea>
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
        $('#createPurchaseRequestButton').click(function() {
            $('#createNewPRModal').modal('show');
        });

        $(document).ready(function() {
            $('#purchaseRequestsTable').DataTable({
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
            }).buttons().container().appendTo('#purchaseRequestsTable_wrapper .col-md-6:eq(0)');


        });

        $('#formSelectPPMPToPR').change(function(e) {
            const ppmpId = $(this).val();

            if (!ppmpId) return; // Exit if no valid PPMP ID is selected

            $.ajax({
                url: "{{ route('endUserFetchPPMPs') }}", // Route for fetching PPMP data
                type: "POST", // Use GET since you're retrieving data
                data: {
                    _token: "{{ csrf_token() }}",
                    ppmp_id: ppmpId
                }, // Send the selected PPMP ID
                success: function(response) {
                    // Assuming response contains the 'purpose_of_request' data
                    data.forEach(function(ppmp) {
                        $('#formPurposeOfPR').val(ppmp);
                    });
                },
                error: function(xhr) {
                    console.error('Error fetching PPMP data:', xhr.responseText);
                }
            });
        });
    </script>
@endsection
