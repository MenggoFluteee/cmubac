@extends('layouts.app')

@section('title', 'PPMPs')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Project Procurement Management Plans</h3>
            </div>
        </div>

        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="ppmpsTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th>PPMP Code</th>
                                        <th>College/Office/Unit</th>
                                        <th>Created By</th>
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
                url: "{{ route('bacFetchPPMPs') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);

                    hideLoadingIndicator();
                    var table = $('#ppmpsTable').DataTable();
                    table.clear();
                    data.forEach(function(ppmp) {
                        var statusBadge;
                        switch (ppmp.approvalStatus) {
                            case 0:
                                statusBadge = '<span class="badge bg-warning">Pending</span>';
                                break;
                            case 1:
                                statusBadge = '<span class="badge bg-success">Approved</span>';
                                break;
                            case 2:
                                statusBadge = '<span class="badge bg-danger">Disapproved</span>';
                                break;
                            default:
                                statusBadge = '<span class="badge bg-secondary">Unknown</span>';
                        }

                        var viewButton = `<button type="button" class="btn btn-sm btn-success me-1" 
                            onclick="viewItemCategory(
                                ${ppmp.ppmpId}
                            )" title="Edit">
                            <i class="fas fa-eye"></i>
                        </button>`;

                        table.row.add([
                            ppmp.ppmpCode,
                            ppmp.collegeOfficeUnit,
                            ppmp.createdBy,
                            ppmp.dateSubmitted,
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



            refreshRequestedItemsTable();


        });
    </script>

    <script>
        function viewItemCategory(ppmpId) {
            window.location.href = `bac-view-ppmp-details/${ppmpId}`;
        }
    </script>
@endsection
