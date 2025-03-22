@extends('layouts.app')

@section('title', 'Purchase Requests')

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

                        <div class="card-body">
                            <table id="purchaseRequestsTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>Purchase Request No.</th>
                                        <th>College | Office | Unit</th>
                                        <th>Created By</th>
                                        <th>Date Submitted</th>
                                        <th>Status</th>
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

    <script>
        function refreshPurchaseRequestTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('budgetOfficeFetchPurchaseRequests') }}",
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

                        var viewButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="viewPurchaseRequest(${purchaseRequest.id})" title="Edit">
                            <i class="fas fa-eye"></i>
                        </button>`;


                        table.row.add([
                            purchaseRequest.pr_code,
                            purchaseRequest.college_office_unit,
                            purchaseRequest.created_by,
                            purchaseRequest.date_submitted,
                            approvalStatusBadge,
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

        function viewPurchaseRequest(id) {
            window.location.href = `budget-office-purchase-requests-details/${id}`;
        }
    </script>


@endsection
