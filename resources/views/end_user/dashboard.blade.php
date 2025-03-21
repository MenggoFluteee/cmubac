@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Dashboard</h3>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">5</h3>
                                <p class="mb-2">Items</p>

                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <i class="align-middle text-success" data-lucide="package-open"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">45</h3>
                                <p class="mb-2">Units</p>

                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <i class="align-middle text-success" data-lucide="school"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">43</h3>
                                <p class="mb-2">Account Codes</p>

                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <i class="align-middle text-danger" data-lucide="binary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">14</h3>
                                <p class="mb-2">Users</p>

                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <i class="align-middle text-info" data-lucide="users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-5 col-xl-4 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Funds</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="chartjs-dashboard-pie" style="display: block; width: 381px; height: 150px;"
                                        width="381" height="150" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>

                            @php
                                // Generate colors for each source
                                $colors = [];
                                foreach ($groupedData as $source => $amount) {
                                    $colors[$source] = 'hsl(' . rand(0, 360) . ', 70%, 60%)';
                                }
                            @endphp

                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th class="text-end">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedData as $source => $amount)
                                        <tr>
                                            <td><i class="fas fa-square-full" style="color: {{ $colors[$source] }}"></i>
                                                {{ $source }}</td>
                                            <td class="text-end">{{ $amount ? Number::currency($amount, 'PHP') : '' }}</td>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Convert PHP data to JavaScript
            const sourceLabels = @json(array_keys($groupedData));
            const sourceValues = @json(array_values($groupedData));
            const colors = @json(array_values($colors)); // Use the same colors for consistency

            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: sourceLabels,
                    datasets: [{
                        data: sourceValues,
                        backgroundColor: colors, // Use the same colors from the table
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    },
                    elements: {
                        arc: {
                            borderWidth: 5,
                            borderColor: window.cssVariables.secondaryBg
                        }
                    },
                }
            });
        });
    </script>


@endsection
