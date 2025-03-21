@extends('layouts.app')

@section('title', 'PPMP Details')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 d-flex align-items-center">
            <div class="col d-flex align-items-center">
                <h3 class="mb-0">PPMP {{ $ppmp->ppmp_code }} of
                    {{ $ppmp->createdBy->collegeOfficeUnit->college_office_unit_name }}</h3>
                <div class="ms-3">
                    @if ($ppmp->approval_status == 0)
                        <span class="badge bg-warning">Pending</span>
                    @elseif($ppmp->approval_status == 1)
                        <span class="badge bg-success">Approved</span>
                    @elseif($ppmp->approval_status == 2)
                        <span class="badge bg-danger">Disapproved</span>
                    @endif
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary" onclick="showUpdateStatusModal({{ $ppmp->id }})">Update Status <i
                        class="fas fa-edit ml-3"></i></button>

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
                                        TOTAL AMOUNT:
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
        <div class="card">
            <table class="table table-sm table-responsive table-bordered table-hover w-100">
                <thead>
                    <th colspan="5" class="text-center">Available Budget</th>
                    <tr style="background-color: #02681d6e">
                        <th class="text-center">Account Code</th>
                        <th class="text-center">Source of Fund</th>
                        <th class="text-center">Allocated Amount</th>
                        <th class="text-center">Utilized Amount</th>
                        <th class="text-center">Remaining Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Calculate total utilized amount from PPMP items
                        $totalUtilizedAmount = $ppmp->ppmpItems->sum(function ($item) {
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
                            return $totalQty *
                                (optional($item->item->prices()->where('is_active', 1)->first())->price ?? 0);
                        });

                        // Calculate remaining balance
                        $allocatedAmount = $ppmp->budgetAllocation->amount ?? 0;
                        $remainingBalance = $allocatedAmount - $totalUtilizedAmount;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $ppmp->budgetAllocation->accountCode->account_name }}</td>
                        <td class="text-center">{{ $ppmp->budgetAllocation->wholeBudget->source_of_fund }}</td>
                        <td class="text-end">
                            {{ $ppmp->budgetAllocation->amount ? Number::currency($ppmp->budgetAllocation->amount, 'PHP') : '₱0.00' }}
                        </td>
                        <td class="text-end {{ $totalUtilizedAmount > $allocatedAmount ? 'text-danger' : '' }}">
                            {{ Number::currency($totalUtilizedAmount, 'PHP') }}
                        </td>
                        <td class="text-end fw-bold {{ $remainingBalance < 0 ? 'text-danger' : '' }}">
                            {{ Number::currency($remainingBalance, 'PHP') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card p-4 mt-5">

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
                                        <div class="flex-shrink-1 bg-body-tertiary rounded py-2 px-3 {{ $bubbleMargin }}">
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
                        <form id="addCommentForm" action="{{ route('budgetOfficeAddCommentToPPMP') }}" method="POST">
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

    {{-- Edit PPMP Status Modal --}}
    <div class="modal fade" id="updatePPMPStatusModal" tabindex="-1" role="dialog"
        aria-labelledby="updatePPMPStatusModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Approval Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updatePPMPStatusForm" action="" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <input type="text" hidden name="updatePPMPStatusId" id="updatePPMPStatusId"
                            value="{{ $ppmp->id }}">
                        <div class="col-12 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="updatePPMPStatus" id="updatePPMPStatus" required
                                onchange="toggleCommentSection(this.value)">
                                <option value="" selected disabled @readonly(true)>Select Status</option>
                                <option value="1">Approve ✔</option>
                                <option value="2">Disapprove X</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3" id="commentSection" style="display: none;">
                            <label class="form-label">Comment</label>
                            <textarea name="updatePPMPStatusCommentSection" id="updatePPMPStatusCommentSection" class="form-control"></textarea>
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
        function showUpdateStatusModal(id) {
            $('#updatePPMPStatusModal').modal('show');
        }

        $('#updatePPMPStatusForm').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update the PPMP status?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('budgetOfficeUpdatePPMPStatus') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            formUpdatePPMPStatusId: $('#updatePPMPStatusId').val(),
                            formUpdatePPMPStatus: $('#updatePPMPStatus').val(),
                            formUpdatePPMPStatusComment: $('#updatePPMPStatusCommentSection').val()
                        },
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message
                            }).then(() => {
                                location.reload(); // Refresh the page
                            });
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
                }
            });
        });

        function toggleCommentSection(selectedValue) {
            const commentSection = document.getElementById('commentSection');
            if (selectedValue === '2') {
                commentSection.style.display = 'block';
            } else {
                commentSection.style.display = 'none';
            }
        }
    </script>

@endsection
