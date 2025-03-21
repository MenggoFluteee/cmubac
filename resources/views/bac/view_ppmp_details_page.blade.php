@extends('layouts.app')

@section('title', 'PPMP Details')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 d-flex align-items-center">
            <div class="col d-flex align-items-center">
                <h3 class="mb-0">PPMP Details</h3>
                <div class="ms-3">
                    @if ($ppmp->approval_status == 0)
                        <span class="badge bg-warning">Pending</span>
                    @elseif($ppmp->is_submitted == 1)
                        <span class="badge bg-success">Approved</span>
                    @elseif($ppmp->is_submitted == 2)
                        <span class="badge bg-danger">Disapproved</span>
                    @endif
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-success">Approve <i class="fas fa-check ml-3"></i></button>
                <button class="btn btn-sm btn-danger">Disapprove <i class="fas fa-x ml-3"></i></button>
            </div>
        </div>

        <div class="card p-4">
            <div class="ppmpTemplate px-3" id="ppmpTemplate">
                <div class="text-center align-items-center mt-2">
                    <h2><strong>PROJECT PROCUREMENT MANAGEMENT PLAN
                            {{ $ppmp->budgetAllocation->wholeBudget->year }}</strong></h2>
                </div>

                <br>
                <br>
                <div class="mt-12">
                    <p><em><ins>Instructions:</ins></em></p>
                    <ol class="ml-4">
                        <strong>
                            <li>
                                A PPMP is considered incorrect or invalid if
                                <ol class="ml-8">
                                    <li>form used is other than the prescribed format which can be downloaded only
                                        at
                                        <a href="https://www.cmu.edu.ph/elementor-30017/" target="_blank">www.cmu.edu.ph</a>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                Once accomplished and finalized, the PPMP 2026 form should be:
                                <ol class="ml-8">
                                    <li>Saved using this format: UPDATED_PPMP2026_Name of Unit/College (e.g.
                                        UPDATED_PPMP2026_BAC).</li>
                                    <li>The file in excel format should be emailed to <a
                                            href="mailto:bac@cmu.edu.ph">bac@cmu.edu.ph</a></li>
                                    <li>Printed and signed by the Head of Unit/College Dean. The signed copy must be
                                        submitted
                                        to the Budget Office.</li>
                                </ol>
                            </li>
                        </strong>
                    </ol>
                </div>

                <br>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="table">
                        <thead class="text-center" style="background-color:#FFCC99">
                            <tr>
                                <th rowspan="2" class="align-middle">CODE</th>
                                <th rowspan="2" class="align-middle">GENERAL DESCRIPTION</th>
                                <th rowspan="2" class="align-middle" style="min-width: 90px;">Unit of Measure</th>
                                <th class="align-middle">QTY</th>
                                <th rowspan="2" class="align-middle" style="min-width: 120px;">UNIT COST</th>
                                <th rowspan="2" class="align-middle" style="min-width: 120px;">ESTIMATED BUDGET</th>
                                <th rowspan="2" class="align-middle" style="min-width: 120px;">Mode of Procurement</th>
                                <th colspan="12" class="align-middle">SCHEDULE/MILESTONES OF ACTIVITIES</th>
                            </tr>
                            <tr>
                                <th class="align-middle">Size</th>
                                @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                                    <th class="align-middle">{{ $month }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @if ($ppmp->ppmpItems && $ppmp->ppmpItems->isNotEmpty())
                                {{-- Part I: PS-DBM Items --}}
                                <tr>
                                    <td colspan="20" style="background-color: #FFE497; padding: 8px;">
                                        <div class="d-flex justify-content-between align-items-center w-100 fw-bold">
                                            <span>PART I. AVAILABLE AT PS-DBM (MAIN WAREHOUSE AND DEPOTS)</span>
                                        </div>
                                    </td>
                                </tr>

                                @php
                                    $currentCategory = null;
                                    $psdbmItems = $ppmp->ppmpItems
                                        ->where('item.is_psdbm', 1)
                                        ->sortBy('item.itemCategory.item_category_name');
                                @endphp

                                @foreach ($psdbmItems as $ppmpItem)
                                    @php
                                        $categoryName =
                                            $ppmpItem->item->itemCategory->item_category_name ?? 'Uncategorized';
                                    @endphp

                                    @if ($categoryName !== $currentCategory)
                                        <tr>
                                            <td colspan="20" class="text-start fw-bold text-uppercase"
                                                style="background-color: #8EAADB">
                                                {{ $categoryName }}
                                            </td>
                                        </tr>
                                        @php
                                            $currentCategory = $categoryName;
                                        @endphp
                                    @endif

                                    {{-- Item Row --}}
                                    <tr>
                                        <td class="text-center">{{ $ppmpItem->item->item_code }}</td>
                                        <td>{{ $ppmpItem->item->item_name }}</td>
                                        <td class="text-center">{{ $ppmpItem->item->unit_of_measure }}</td>

                                        @php
                                            $totalQuantity =
                                                ($ppmpItem->january_quantity ?? 0) +
                                                ($ppmpItem->february_quantity ?? 0) +
                                                ($ppmpItem->march_quantity ?? 0) +
                                                ($ppmpItem->april_quantity ?? 0) +
                                                ($ppmpItem->may_quantity ?? 0) +
                                                ($ppmpItem->june_quantity ?? 0) +
                                                ($ppmpItem->july_quantity ?? 0) +
                                                ($ppmpItem->august_quantity ?? 0) +
                                                ($ppmpItem->september_quantity ?? 0) +
                                                ($ppmpItem->october_quantity ?? 0) +
                                                ($ppmpItem->november_quantity ?? 0) +
                                                ($ppmpItem->december_quantity ?? 0);

                                            $itemPrice =
                                                optional($ppmpItem->item->prices()->where('is_active', 1)->first())
                                                    ->price ?? 0;
                                            $estimatedBudget = $totalQuantity * $itemPrice;
                                        @endphp

                                        <td class="text-center">{{ $totalQuantity }}</td>
                                        <td class="text-end">{{ Number::currency($itemPrice, 'PHP') }}</td>
                                        <td class="text-end">{{ Number::currency($estimatedBudget, 'PHP') }}</td>
                                        <td class="text-center">PS-DBM</td>

                                        <td class="text-center">{{ $ppmpItem->january_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->february_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->march_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->april_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->may_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->june_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->july_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->august_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->september_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->october_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->november_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->december_quantity ?? 0 }}</td>
                                    </tr>
                                @endforeach

                                {{-- Part II: Non PS-DBM Items --}}
                                <tr>
                                    <td colspan="20" style="background-color: #FFE497; padding: 8px;">
                                        <div class="d-flex justify-content-between align-items-center w-100 fw-bold">
                                            <span>PART II. OTHER ITEMS NOT AVAILABLE AT PS-DBM BUT ARE REGULARLY PURCHASED
                                                FROM OTHER SOURCES (NOTE: PLEASE INDICATE PRICE OF ITEMS)</span>
                                        </div>
                                    </td>
                                </tr>

                                @php
                                    $currentCategory = null;
                                    $nonPsdbmItems = $ppmp->ppmpItems
                                        ->where('item.is_psdbm', 0)
                                        ->sortBy('item.itemCategory.item_category_name');
                                @endphp

                                @foreach ($nonPsdbmItems as $ppmpItem)
                                    @php
                                        $categoryName =
                                            $ppmpItem->item->itemCategory->item_category_name ?? 'Uncategorized';
                                    @endphp

                                    @if ($categoryName !== $currentCategory)
                                        <tr>
                                            <td colspan="20" class="text-start fw-bold text-uppercase"
                                                style="background-color: #8EAADB">
                                                {{ $categoryName }}
                                            </td>
                                        </tr>
                                        @php
                                            $currentCategory = $categoryName;
                                        @endphp
                                    @endif

                                    {{-- Item Row --}}
                                    <tr>
                                        <td class="text-center">{{ $ppmpItem->item->item_code }}</td>
                                        <td>{{ $ppmpItem->item->item_name }}</td>
                                        <td class="text-center">{{ $ppmpItem->item->unit_of_measure }}</td>

                                        @php
                                            $totalQuantity =
                                                ($ppmpItem->january_quantity ?? 0) +
                                                ($ppmpItem->february_quantity ?? 0) +
                                                ($ppmpItem->march_quantity ?? 0) +
                                                ($ppmpItem->april_quantity ?? 0) +
                                                ($ppmpItem->may_quantity ?? 0) +
                                                ($ppmpItem->june_quantity ?? 0) +
                                                ($ppmpItem->july_quantity ?? 0) +
                                                ($ppmpItem->august_quantity ?? 0) +
                                                ($ppmpItem->september_quantity ?? 0) +
                                                ($ppmpItem->october_quantity ?? 0) +
                                                ($ppmpItem->november_quantity ?? 0) +
                                                ($ppmpItem->december_quantity ?? 0);

                                            $itemPrice =
                                                optional($ppmpItem->item->prices()->where('is_active', 1)->first())
                                                    ->price ?? 0;
                                            $estimatedBudget = $totalQuantity * $itemPrice;
                                        @endphp

                                        <td class="text-center">{{ $totalQuantity }}</td>
                                        <td class="text-end">{{ Number::currency($itemPrice, 'PHP') }}</td>
                                        <td class="text-end">{{ Number::currency($estimatedBudget, 'PHP') }}</td>
                                        <td class="text-center">Non PS-DBM</td>

                                        <td class="text-center">{{ $ppmpItem->january_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->february_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->march_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->april_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->may_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->june_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->july_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->august_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->september_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->october_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->november_quantity ?? 0 }}</td>
                                        <td class="text-center">{{ $ppmpItem->december_quantity ?? 0 }}</td>
                                    </tr>
                                @endforeach

                                {{-- Total Budget Row --}}
                                <tr>
                                    <td colspan="20" class="text-start fw-bold" style="background-color: #8EAADB">
                                        TOTAL BUDGET:
                                        {{ Number::currency(
                                            $ppmp->ppmpItems->sum(function ($item) {
                                                $totalQty =
                                                    ($item->january_quantity ?? 0) +
                                                    ($item->february_quantity ?? 0) +
                                                    ($item->march_quantity ?? 0) +
                                                    ($item->april_quantity ?? 0) +
                                                    ($item->may_quantity ?? 0) +
                                                    ($item->june_quantity ?? 0) +
                                                    ($item->july_quantity ?? 0) +
                                                    ($item->august_quantity ?? 0) +
                                                    ($item->september_quantity ?? 0) +
                                                    ($item->october_quantity ?? 0) +
                                                    ($item->november_quantity ?? 0) +
                                                    ($item->december_quantity ?? 0);
                                                return $totalQty * (optional($item->item->prices()->where('is_active', 1)->first())->price ?? 0);
                                            }),
                                            'PHP',
                                        ) }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="20" class="text-center text-muted">No items available for this account
                                        code.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
