@extends('layouts.app')

@section('title', 'Budgets Page')

@section('content')
    <div class="container-fluid p-0 d-flex flex-column vh-100"> {{-- vh-100 ensures full viewport height --}}

        {{-- Page Header --}}
        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Budgets</h1>
            </div>
            <div class="col-auto ms-auto">
                <div class="d-flex align-items-center">
                    <form method="GET">
                        <label for="filterByYear" class="me-2">Select Year:</label>
                        <select name="filterByYear" id="filterByYear" class="form-select" onchange="this.form.submit()">
                            @foreach ($years as $year)
                                <option value="{{ $year->year }}" {{ $year->year == $selectedYear ? 'selected' : '' }}>
                                    {{ $year->year }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        {{-- Full-Height Card --}}
        <div class="row flex-grow-1">
            <div class="col-xl-12 col-lg-12 col-md-12 h-100">
                <div class="card h-100 d-flex flex-column">
                    <div class="card-body d-flex flex-column flex-grow-1">

                        {{-- Export Buttons --}}
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

                        {{-- Scrollable Table --}}
                        <div id="exportContainer" class="flex-grow-1 table-responsive"
                            style="overflow-y: auto; max-height: calc(100vh - 200px);">
                            <table class="table table-bordered table-hover w-100">
                                <thead>
                                    <tr style="background-color: rgba(2, 104, 30, 0.3)">
                                        <th style="width: 30%">Commodity Group</th>
                                        @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'General Fund')->sum('amount')) > 0)
                                            <th>General Fund</th>
                                        @endif
                                        @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'Trust Fund')->sum('amount')) > 0)
                                            <th>Trust Fund</th>
                                        @endif
                                        @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'Special Trust Fund')->sum('amount')) > 0)
                                            <th>Special Trust Fund</th>
                                        @endif
                                        @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'RGMO')->sum('amount')) > 0)
                                            <th>RGMO</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountCodes as $code)
                                        <tr>
                                            <td>{{ $code->account_name }}</td>
                                            @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'General Fund')->sum('amount')) > 0)
                                                <td style="text-align: right">
                                                    {{ Number::currency($code->budgetAllocations->where('wholeBudget.source_of_fund', 'General Fund')->sum('amount'), 'PHP') }}
                                                </td>
                                            @endif
                                            @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'Trust Fund')->sum('amount')) > 0)
                                                <td style="text-align: right">
                                                    {{ Number::currency($code->budgetAllocations->where('wholeBudget.source_of_fund', 'Trust Fund')->sum('amount'), 'PHP') }}
                                                </td>
                                            @endif
                                            @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'Special Trust Fund')->sum('amount')) > 0)
                                                <td style="text-align: right">
                                                    {{ Number::currency($code->budgetAllocations->where('wholeBudget.source_of_fund', 'Special Trust Fund')->sum('amount'), 'PHP') }}
                                                </td>
                                            @endif
                                            @if ($accountCodes->sum(fn($code) => $code->budgetAllocations->where('wholeBudget.source_of_fund', 'RGMO')->sum('amount')) > 0)
                                                <td style="text-align: right">
                                                    {{ Number::currency($code->budgetAllocations->where('wholeBudget.source_of_fund', 'RGMO')->sum('amount'), 'PHP') }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> {{-- End Scrollable Table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
