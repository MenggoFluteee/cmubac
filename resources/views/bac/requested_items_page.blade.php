@extends('layouts.app')

@section('title', 'Requested Items')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Requested Items</h3>
            </div>
        </div>

        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="requestedItemTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Item Description</th>
                                        <th>College | Office | Unit Requested</th>
                                        <th>Date Submitted</th>
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
    </div>


    <script>
        function refreshRequestedItemsTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('bacOfficeFetchRequestedItems') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#requestedItemTable').DataTable();
                    table.clear();
                    data.forEach(function(requestedItem) {
                        var viewButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="viewRequestedItemDetails(
                                ${requestedItem.id}
                            )" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>`;


                        let statusBadge = "";
                        if (requestedItem.approval_status == 0) {
                            statusBadge = '<span class="badge bg-warning">Pending</span>';
                        } else if (requestedItem.approval_status == 1) {
                            statusBadge = '<span class="badge bg-success">Approved</span>';
                        } else if (requestedItem.approval_status == 2) {
                            statusBadge = '<span class="badge bg-danger">Disapproved</span>';
                        } // Add more cases if needed
                        table.row.add([
                            requestedItem.item_name,
                            requestedItem.item_description,
                            requestedItem.college_office_unit_name,
                            requestedItem.created_at,
                            statusBadge,
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
            $('#requestedItemTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#requestedItemTable_wrapper .col-md-6:eq(0)');



            refreshRequestedItemsTable();


        });
    </script>
    <script>
        function viewRequestedItemDetails(id) {
            window.location.href = `bac-view-requested-item-details/${id}`;
        }
    </script>
@endsection
