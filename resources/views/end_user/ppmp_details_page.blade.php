@extends('layouts.app')

@section('title', 'PPMP Detail')

@section('content')

    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="ppmpTemplate px-3" id="ppmpTemplate">
                <div class="text-center align-items-center mt-2">
                    @if ($ppmp->is_submitted == 0)
                        <span class="badge bg-warning mb-2">Draft</span>
                    @elseif($ppmp->is_submitted == 1)
                        <span class="badge bg-success mb-2">Submitted</span>
                    @endif


                    <h2><strong>PROJECT PROCUREMENT MANAGEMENT PLAN
                            {{ $ppmp->budgetAllocation->wholeBudget->year }}</strong></h2>


                    @if ($ppmp->approval_status == 0)
                        <span class="badge bg-warning mb-2">Pending</span>
                    @elseif ($ppmp->approval_status == 1)
                        <span class="badge bg-success mb-2">Approved</span>
                    @elseif ($ppmp->approval_status == 2)
                        <span class="badge bg-danger mb-2">Disapproved</span>
                    @endif


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



                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <p><em>{{ Auth::user()->collegeOfficeUnit->college_office_unit_name }}</em></p>
                    </div>
                    @if ($ppmp->is_submitted == 0)
                        <div class="col-xl-6 col-lg-6 col-md-6 text-end">
                            <button class="btn btn-sm btn-success" onclick="showAddItemToPPMPModal()"><i data-lucide="plus"
                                    class="lucide lucide-plus"> </i> Add
                                Item</button>

                        </div>
                    @endif



                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm" id="table">
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

                        <!-- Table Body - Reuse your existing tbody code here but with responsive classes -->
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
                                    <tr
                                        onclick="openEditModal(
                                        '{{ $ppmpItem->id }}',
                                        '{{ $ppmpItem->item->item_code }}',
                                        '{{ $ppmpItem->item->item_name }}',
                                        '{{ $ppmpItem->item->itemCategory->item_category_name ?? '' }}',
                                        '{{ $ppmpItem->item->item_description ?? '' }}',
                                        '{{ $ppmpItem->item->is_psdbm }}',
                                        '{{ $ppmpItem->item->accountCode->account_name ?? '' }}',
                                        '{{ $ppmpItem->item->unit_of_measure }}',
                                        '{{ $ppmpItem->item->prices()->where('is_active', 1)->first()
                                            ? Number::currency($ppmpItem->item->prices()->where('is_active', 1)->first()->price, 'PHP')
                                            : '₱0.00' }}',
                                        '{{ $ppmpItem->january_quantity ?? 0 }}',
                                        '{{ $ppmpItem->february_quantity ?? 0 }}',
                                        '{{ $ppmpItem->march_quantity ?? 0 }}',
                                        '{{ $ppmpItem->april_quantity ?? 0 }}',
                                        '{{ $ppmpItem->may_quantity ?? 0 }}',
                                        '{{ $ppmpItem->june_quantity ?? 0 }}',
                                        '{{ $ppmpItem->july_quantity ?? 0 }}',
                                        '{{ $ppmpItem->august_quantity ?? 0 }}',
                                        '{{ $ppmpItem->september_quantity ?? 0 }}',
                                        '{{ $ppmpItem->october_quantity ?? 0 }}',
                                        '{{ $ppmpItem->november_quantity ?? 0 }}',
                                        '{{ $ppmpItem->december_quantity ?? 0 }}'
                                    )">
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
                                                FROM
                                                OTHER SOURCES (NOTE: PLEASE INDICATE PRICE OF ITEMS)</span>
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
                                    <tr
                                        onclick="openEditModal(
                                        '{{ $ppmpItem->id }}',
                                        '{{ $ppmpItem->item->item_code }}',
                                        '{{ $ppmpItem->item->item_name }}',
                                        '{{ $ppmpItem->item->itemCategory->item_category_name ?? '' }}',
                                        '{{ $ppmpItem->item->item_description ?? '' }}',
                                        '{{ $ppmpItem->item->is_psdbm }}',
                                        '{{ $ppmpItem->item->accountCode->account_name ?? '' }}',
                                        '{{ $ppmpItem->item->unit_of_measure }}',
                                        '{{ $ppmpItem->item->prices()->where('is_active', 1)->first()
                                            ? Number::currency($ppmpItem->item->prices()->where('is_active', 1)->first()->price, 'PHP')
                                            : '₱0.00' }}',
                                        '{{ $ppmpItem->january_quantity ?? 0 }}',
                                        '{{ $ppmpItem->february_quantity ?? 0 }}',
                                        '{{ $ppmpItem->march_quantity ?? 0 }}',
                                        '{{ $ppmpItem->april_quantity ?? 0 }}',
                                        '{{ $ppmpItem->may_quantity ?? 0 }}',
                                        '{{ $ppmpItem->june_quantity ?? 0 }}',
                                        '{{ $ppmpItem->july_quantity ?? 0 }}',
                                        '{{ $ppmpItem->august_quantity ?? 0 }}',
                                        '{{ $ppmpItem->september_quantity ?? 0 }}',
                                        '{{ $ppmpItem->october_quantity ?? 0 }}',
                                        '{{ $ppmpItem->november_quantity ?? 0 }}',
                                        '{{ $ppmpItem->december_quantity ?? 0 }}'
                                    )">
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


                <br>
                <div class="row mt-2">
                    <div class="col-12 col-md-4 text-center mb-4 mb-md-0">
                        <p class="mb-2">Prepared By:</p>
                        <h4 class="mb-1"><ins>{{ strtoupper(Auth::user()->firstname) }}
                                {{ strtoupper(Auth::user()->middlename) }}. {{ strtoupper(Auth::user()->lastname) }}</ins>
                        </h4>
                        <small>Unit Head/College Dean</small>
                    </div>
                    <div class="col-12 col-md-4 text-center mb-4 mb-md-0">
                        <p class="mb-2">Reviewed By:</p>
                        <h4 class="mb-1"><ins>CHARLIE A. MUNDAL</ins></h4>
                        <small>Head, Budget Office</small>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <p class="mb-2">Approved By:</p>
                        <h4 class="mb-1"><ins>ROLITO G. EBALLE, Ph. D</ins></h4>
                        <small>University President</small>
                    </div>
                </div>
                <div class="text-center mt-5">

                    @if ($ppmp->approval_status == 0)
                        @if ($ppmp->is_submitted == 0)
                            <button type="submit" class="btn btn-sm btn-success"
                                onclick="submitPPMPTemplate({{ $ppmp->id }}, {{ $ppmp->is_submitted }})">Submit</button>
                        @elseif ($ppmp->is_submitted == 1)
                            <button type="submit" class="btn btn-sm btn-warning"
                                onclick="submitPPMPTemplate({{ $ppmp->id }}, {{ $ppmp->is_submitted }})">Unsubmit</button>
                        @endif
                    @endif
                </div>
            </div>
            <div class="container-fluid  mt-5">
                <div class="card p-4">

                    <h1 class="h3 mb-3">Comments</h1>

                    <div class="card">
                        <div class="col-12 col-lg-12 col-xl-12">

                            <div class="position-relative">
                                <div class="chat-messages p-4">

                                    @if ($ppmp->ppmpComments->isEmpty())
                                        <div class="text-center text-muted">There are no comments yet.</div>
                                    @else
                                        @foreach ($ppmp->ppmpComments->sortBy('created_at') as $comment)
                                            @php
                                                $isCurrentUser = Auth::id() === $comment->from_user;
                                                $messagePosition = $isCurrentUser ? 'right' : 'left';
                                                $bubbleMargin = $isCurrentUser ? 'me-3' : 'ms-3';
                                            @endphp

                                            <div class="chat-message-{{ $messagePosition }} pb-4">
                                                <div>
                                                    @if ($comment->user->sex == 1)
                                                        <img src="{{ asset('images/maleProfile.png') }}"
                                                            class="rounded-circle me-1" alt="User Avatar" width="40"
                                                            height="40">
                                                    @else
                                                        <img src="{{ asset('images/femaleProfile.png') }}"
                                                            class="rounded-circle me-1" alt="User Avatar" width="40"
                                                            height="40">
                                                    @endif
                                                    <div class="text-muted small text-nowrap mt-2">
                                                        {{ $comment->created_at ? $comment->created_at->format('m/d/y | h:i A') : '' }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex-shrink-1 bg-body-tertiary rounded py-2 px-3 {{ $bubbleMargin }}">
                                                    <div class="fw-bold mb-1">
                                                        {{ $comment->user->firstname }}
                                                        {{ substr($comment->user->middlename, 0, 1) }}.
                                                        {{ $comment->user->lastname }}
                                                    </div>
                                                    {{ $comment->comment }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <form id="addCommentForm" action="{{ route('endUserAddCommentToPPMP') }}"
                                    method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" hidden id="addCommentId" name="addCommentId"
                                            value="{{ $ppmp->id }}">
                                        <input type="text" name="addComment" id="addComment" class="form-control"
                                            placeholder="Type comment here ..." required>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade modal-xl" id="addItemToPPMPModal" tabindex="-1" role="dialog"
        aria-labelledby="addItemToPPMPModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addItemToPPMForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-square-exclamation"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>Note!</strong> If the desired item is not on the list provided below, it
                                        might be that it does not align to the PPMP Account Code you created or the item is
                                        not available. If the item is not available, please proceed to the item request page
                                        and request for one. <a href="{{ route('userRequestItemsPage') }}">Click here
                                        </a> to proceed to item request page.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <input type="text" hidden id="formPPMPId" name="formPPMPId"
                                    value="{{ $ppmp->id }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Select an Item to Add</label>
                                <select class="form-select select2" style="width: 100%" name="formSelectItemToPPMP"
                                    id="formSelectItemToPPMP" required onchange="toggleMilestoneTable()">
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Quantity per Milestone</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="janMilestoneQuantity" id="janMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="febMilestoneQuantity" id="febMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="marMilestoneQuantity" id="marMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="aprMilestoneQuantity" id="aprMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="mayMilestoneQuantity" id="mayMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="junMilestoneQuantity" id="junMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="julMilestoneQuantity" id="julMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="augMilestoneQuantity" id="augMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="sepMilestoneQuantity" id="sepMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="octMilestoneQuantity" id="octMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="novMilestoneQuantity" id="novMilestoneQuantity" min="0"
                                                    disabled></td>
                                            <td><input type="number" class="form-control milestone-input"
                                                    name="decMilestoneQuantity" id="decMilestoneQuantity" min="0"
                                                    disabled></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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

    <div class="modal fade modal-xl" id="editItemToPPMPModal" tabindex="-1" role="dialog"
        aria-labelledby="editItemToPPMPModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editItemToPPMPForm" action="{{ route('endUserEditPPMPItem') }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label"><strong>
                                        <h4>Item Details</h4>
                                    </strong></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" hidden id="editPPMPItemId" name="editPPMPItemId">
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 320px;">Name</th>
                                                        <td id="editItemName"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Category</th>
                                                        <td id="editItemCategory"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Code</th>
                                                        <td id="editItemCode"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Description</th>
                                                        <td id="editItemDescription"></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 320px;">Unit of Measure</th>
                                                        <td id="editItemUnit"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mode of Procurement</th>
                                                        <td id="editItemMoP"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Account Code</th>
                                                        <td id="editItemAccountCode"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Item Price</th>
                                                        <td id="editItemPrice"></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label"><strong>
                                        <h4>Quantity per Milestone</h4>
                                    </strong></label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="number" class="form-control" id="editJanMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editFebMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editMarMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editAprMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editMayMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editJunMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editJulMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editAugMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editSepMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editOctMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editNovMilestoneQuantity">
                                            </td>
                                            <td><input type="number" class="form-control" id="editDecMilestoneQuantity">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" id="deleteItemButton"
                            @if ($ppmp->is_submitted == 1) style="display: none;" @endif>
                            <i class="fas fa-trash"></i> Delete Item
                        </button>

                        <!-- Right-aligned Cancel & Save Buttons -->
                        <div>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <!-- Save Changes Button -->
                            <button type="submit" class="btn btn-success"
                                @if ($ppmp->is_submitted == 1) style="display: none;" @endif>
                                <i class="fas fa-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function submitPPMPTemplate(ppmpId, isSubmitted) {
            // Determine the title and text based on the isSubmitted value
            let alertTitle = isSubmitted ? "Are you sure you want to unsubmit this PPMP?" :
                "Are you sure you want to submit this PPMP?";
            let alertText = isSubmitted ? "Once this PPMP is unsubmitted, the BAC Office will no longer see this plan." :
                "Once this PPMP is submitted, the BAC Office will be able to see this plan and you can no longer unsubmit.";

            Swal.fire({
                title: alertTitle,
                text: alertText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('endUserSubmitPPMPTemplate') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            ppmp_id: ppmpId, // Send the ID via POST data
                            is_submitted: isSubmitted, // Send the ID via POST data
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Success!', `${response.message}`, 'success').then(() => {
                                    location.reload(); // Refresh the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }

                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {

                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>

    <script>
        // Javascript function to defaulty disable all the quantity per milestone input
        // And only enable inputting when an item is selected or there is a value in the 
        // Item select 
        function toggleMilestoneTable() {
            let select = document.getElementById("formSelectItemToPPMP");
            let inputs = document.querySelectorAll(".milestone-input");

            if (select.value) {
                inputs.forEach(input => input.removeAttribute("disabled"));
            } else {
                inputs.forEach(input => input.setAttribute("disabled", "true"));
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#addItemToPPMPModal').on('shown.bs.modal', function() {
                $("#formSelectItemToPPMP").select2({
                    dropdownParent: $("#addItemToPPMPModal"), // Attach Select2 to the modal
                    placeholder: "Find an item",
                    allowClear: true,
                    minimumInputLength: 3, // Requires at least 3 characters before searching
                    ajax: {
                        url: "{{ route('fetchItemsForPPMP') }}", // Ensure this matches the correct route
                        type: "POST",
                        dataType: "json",
                        delay: 250,

                        data: function(params) {
                            return {
                                _token: "{{ csrf_token() }}",
                                search: params.term,
                                ppmp_id: $("#formPPMPId").val()
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data
                                    .results // Ensure it matches the controller response
                            };
                        }
                    }
                });
            });
        });
    </script>

    <script>
        function showRequestItemToPPMPModal() {
            $('#requestNewItemModal').modal('show');
        }

        function showAddItemToPPMPModal() {
            $('#addItemToPPMPModal').modal('show');
        }

        $('#addItemToPPMForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('endUserAddItemToPPMP') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ppmpId: $('#formPPMPId').val(),
                    itemId: $('#formSelectItemToPPMP').val(),
                    janMilsQuantity: $('#janMilestoneQuantity').val(),
                    febMilsQuantity: $('#febMilestoneQuantity').val(),
                    marMilsQuantity: $('#marMilestoneQuantity').val(),
                    aprMilsQuantity: $('#aprMilestoneQuantity').val(),
                    mayMilsQuantity: $('#mayMilestoneQuantity').val(),
                    junMilsQuantity: $('#junMilestoneQuantity').val(),
                    julMilsQuantity: $('#julMilestoneQuantity').val(),
                    augMilsQuantity: $('#augMilestoneQuantity').val(),
                    sepMilsQuantity: $('#sepMilestoneQuantity').val(),
                    octMilsQuantity: $('#octMilestoneQuantity').val(),
                    novMilsQuantity: $('#novMilestoneQuantity').val(),
                    decMilsQuantity: $('#decMilestoneQuantity').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#addItemToPPMForm')[0].reset();
                        $('#addItemToPPMPModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(() => {
                            location.reload(); // Refresh the page
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong.'
                    });
                    console.error(xhr.responseText);
                }
            });
        });

        function openEditModal(ppmpItemId, code, name, cat, desc, psdbm, accName, unit, price, jan, feb, mar, apr, may, jun,
            jul, aug,
            sep,
            oct, nov, dec) {
            $('#editItemName').text(name);
            $('#editItemCategory').text(cat);
            $('#editItemCode').text(code);
            $('#editItemDescription').text(desc);
            $('#editItemUnit').text(desc);
            if (psdbm == 1) {
                $('#editItemMoP').text('PS-DBM');
            } else {
                $('#editItemMoP').text('Non PS-DBM');
            }

            $('#editItemAccountCode').text(accName);
            $('#editItemPrice').text(price);


            $('#editPPMPItemId').val(ppmpItemId);
            $('#editJanMilestoneQuantity').val(jan);
            $('#editFebMilestoneQuantity').val(feb);
            $('#editMarMilestoneQuantity').val(mar);
            $('#editAprMilestoneQuantity').val(apr);
            $('#editMayMilestoneQuantity').val(may);
            $('#editJunMilestoneQuantity').val(jun);
            $('#editJulMilestoneQuantity').val(jul);
            $('#editAugMilestoneQuantity').val(aug);
            $('#editSepMilestoneQuantity').val(sep);
            $('#editOctMilestoneQuantity').val(oct);
            $('#editNovMilestoneQuantity').val(nov);
            $('#editDecMilestoneQuantity').val(dec);

            const deleteButton = document.getElementById("deleteItemButton");
            deleteButton.setAttribute("data-item-id", ppmpItemId);

            $('#editItemToPPMPModal').modal('show');
        }


        $('#editItemToPPMPForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('endUserEditPPMPItem') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    PPMPItemId: $('#editPPMPItemId').val(),
                    janMilsQuantity: $('#editJanMilestoneQuantity').val(),
                    febMilsQuantity: $('#editFebMilestoneQuantity').val(),
                    marMilsQuantity: $('#editMarMilestoneQuantity').val(),
                    aprMilsQuantity: $('#editAprMilestoneQuantity').val(),
                    mayMilsQuantity: $('#editMayMilestoneQuantity').val(),
                    junMilsQuantity: $('#editJunMilestoneQuantity').val(),
                    julMilsQuantity: $('#editJulMilestoneQuantity').val(),
                    augMilsQuantity: $('#editAugMilestoneQuantity').val(),
                    sepMilsQuantity: $('#editSepMilestoneQuantity').val(),
                    octMilsQuantity: $('#editOctMilestoneQuantity').val(),
                    novMilsQuantity: $('#editNovMilestoneQuantity').val(),
                    decMilsQuantity: $('#editDecMilestoneQuantity').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editItemToPPMPForm')[0].reset();
                        $('#editItemToPPMPModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(() => {
                            location.reload(); // Refresh the page
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }

                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong.'
                    });
                    console.error(xhr.responseText);
                }
            });

        });


        document.getElementById("deleteItemButton").addEventListener("click", function() {
            const itemId = this.getAttribute("data-item-id");

            if (!itemId) {
                Swal.fire({
                    icon: "warning",
                    title: "No item selected",
                    text: "Please select an item before attempting to delete.",
                });
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "This item will be permanently deleted.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('endUserDeleteItemFromPPMP') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            item_id: itemId, // Send the ID via POST data
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message
                                }).then(() => {
                                    location.reload(); // Refresh the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error').then(() => {

                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        });
    </script>
@endsection
