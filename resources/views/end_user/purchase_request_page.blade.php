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
                            <table class="table table-responsive w-100 table-hover" id="purchaseRequestsTable">
                                <thead>
                                    <tr>
                                        <th>PR Code</th>
                                        <th>Submission Status</th>
                                        <th>Approval Status</th>
                                        <th>Created By</th>
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
    <div class="modal fade" id="createNewPRModal" tabindex="-1" role="dialog" aria-labelledby="createNewPRModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewPRForm" action="{{ route('endUserCreateNewPR') }}" method="POST">
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
                            <textarea class="form-control" id="purposeOfRequest" name="purposeOfRequest"></textarea>
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

        function refreshPurchaseRequestTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('endUserFetchPurchaseRequests') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#purchaseRequestsTable').DataTable();
                    table.clear();
                    data.forEach(function(purchaseRequest) {

                        var approvalStatusBadge;
                        switch (purchaseRequest.approval_status) {
                            case 0:
                                approvalStatusBadge = '<span class="badge bg-warning">Pending</span>';
                                break;
                            case 1:
                                approvalStatusBadge = '<span class="badge bg-success">Approved</span>';
                                break;
                            case 2:
                                approvalStatusBadge =
                                    '<span class="badge bg-danger">Disapproved</span>';
                                break;
                            default:
                                approvalStatusBadge = '<span class="badge bg-secondary">Unknown</span>';
                        }
                        var submissionStatusBadge;
                        switch (purchaseRequest.approval_status) {
                            case 0:
                                submissionStatusBadge = '<span class="badge bg-warning">Draft</span>';
                                break;
                            case 1:
                                submissionStatusBadge =
                                    '<span class="badge bg-success">Submitted</span>';
                                break;

                            default:
                                submissionStatusBadge =
                                    '<span class="badge bg-secondary">Unknown</span>';
                        }
                        var viewButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="viewPurchaseRequest(${purchaseRequest.id})" title="Edit">
                            <i class="fas fa-eye"></i>
                        </button>`;


                        table.row.add([
                            purchaseRequest.pr_code,
                            submissionStatusBadge,
                            approvalStatusBadge,
                            purchaseRequest.created_by,

                            viewButton
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

        function viewPurchaseRequest(id) {
            window.location.href = `end-user-purchase-request-details/${id}`;
        }


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

            }).buttons().container().appendTo('#purchaseRequestsTable_wrapper .col-md-6:eq(0)');
            refreshPurchaseRequestTable();
        });
    </script>
@endsection
