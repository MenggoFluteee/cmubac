@extends('layouts.app')

@section('title', 'PPMPs')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h3 class="mb-0">Project Procurement Management Plan</h3>
            </div>

            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center">
                    <div class="col-6">Filter By Year:</div>
                    <div class="col-6">
                        <select name="filterByYear" id="filterByYear" class="form-control">
                            @foreach ($years as $year)
                                <option value="{{ $year->year }}" {{ $year->is_current == 1 ? 'selected' : '' }}>
                                    {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
        function refreshRequestedItemsTable(year) {
            showLoadingIndicator();

            $.ajax({
                url: "{{ route('budgetFetchPPMPs') }}", // Ensure this route is correctly defined in Laravel
                type: 'GET', // Use GET instead of POST unless your route is explicitly set to POST
                dataType: 'json',
                data: {
                    year: $('#filterByYear').val(),
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
                    onclick="viewItemCategory('${ppmp.hashid}')" title="View">
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



            refreshRequestedItemsTable($('#filterByYear').val());

            $('#filterByYear').change(function(e) {
                refreshRequestedItemsTable($('#filterByYear').val());
            });
        });
    </script>

    <script>
        function viewItemCategory(hashid) {
            window.location.href = `budget-view-ppmp-details/${hashid}`;
        }
    </script>
@endsection
