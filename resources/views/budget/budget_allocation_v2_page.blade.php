@extends('layouts.app')

@section('title', 'Budget Allocation')

@section('content')

    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Budget Allocations V2</h1>
            </div>
        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-start">
                            <h3 class="card-title">List of Colleges, Offices, or Units to be allocated</h3>
                        </div>
                        <div class="card-body">
                            <table id="collegeOfficeUnitToAllocateTable" class="table table-responsive w-100 table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:85%">College / Office / Unit</th>
                                        <th style="width:15%">Action</th>
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
    <script type="text/javascript">
        // Function for getting the default fetch of all the account codes
        function refreshCollegeOfficeUnitToAllocateTable() {
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('budgetOfficeFetchCollegeOfficeUnitToAllocate') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    var table = $('#collegeOfficeUnitToAllocateTable').DataTable();
                    table.clear();

                    data.forEach(function(collegeOfficeUnitToAllocate) {
                        var viewButton =
                            `<button type="button" class="btn btn btn-success me-1" 
                    title="View Information" onclick="viewBudgetAllocation(${collegeOfficeUnitToAllocate.id})">Allocate Budget <i class="fas fa-hand-holding-circle-dollar"></i></button>`;

                        table.row.add([
                            collegeOfficeUnitToAllocate.college_office_unit_name,
                            viewButton
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
            $('#collegeOfficeUnitToAllocateTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,

            }).buttons().container().appendTo('#collegeOfficeUnitToAllocateTable_wrapper .col-md-6:eq(0)');

            refreshCollegeOfficeUnitToAllocateTable();
        });


        function viewBudgetAllocation(id) {
            // Redirect to the route using the provided ID
            window.location.href = `budget-office-allocate-budget-to-college-office-unit-page/${id}`;
        }
    </script>
@endsection
