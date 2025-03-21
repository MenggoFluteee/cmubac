@extends('layouts.app')

@section('title', 'Requested Item Details Page')

@section('content')
    <div class="container-fluid p-0">
        <!-- Responsive header -->
        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col d-flex align-items-center">
                <h3 class="text-center text-sm-start mb-0 me-2">Requested Item Details</h3>

                @if ($requestedItem->approval_status == 0)
                    <span class="badge bg-warning">Pending Request</span>
                @elseif($requestedItem->approval_status == 1)
                    <span class="badge bg-success">Approved</span>
                @elseif($requestedItem->approval_status == 2)
                    <span class="badge bg-danger">Disapproved</span>
                @endif
            </div>
            <div class="col-auto text-end">
                {{ $requestedItem->created_at->format('F d, Y') }}
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary" onclick="updateRequestedItemStatusModal()">Update
                    Status <i class="fas fa-edit ml-3"></i></button>

            </div>
        </div>


        <!-- Main item card with improved responsiveness -->
        <div class="card mb-4">
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <!-- College/Office unit section -->
                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <div class="text-center">
                                @if (empty($requestedItem->collegeOfficeUnit->college_office_unit_image_path))
                                    <img alt="CMU" src="{{ asset('images/cmulogo.png') }}"
                                        class="rounded-circle img-fluid mt-2" style="max-width: 128px; height: auto;">
                                @else
                                    <img alt="CMU"
                                        src="{{ asset('storage/' . $requestedItem->collegeOfficeUnit->college_office_unit_image_path) }}"
                                        class="rounded-circle img-fluid mt-2" style="max-width: 128px; height: auto;">
                                @endif
                                <div class="mt-2">
                                    <h4 class="h5">{{ $requestedItem->collegeOfficeUnit->college_office_unit_name }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Item details section -->
                        <div class="col-lg-8 col-md-6">
                            <div class="row g-2">
                                <div class="col-sm-8 col-12">
                                    <div class="mb-3">
                                        <label for="itemName" class="form-label">Item Name</label>
                                        <input type="text" class="form-control" id="itemName"
                                            value="{{ $requestedItem->item_name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <div class="mb-3">
                                        <label for="measureUnit" class="form-label">Measurement Unit</label>
                                        <input type="text" class="form-control" id="measureUnit"
                                            value="{{ $requestedItem->unit_of_measure }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="itemDescription" class="form-label">Description</label>
                                <textarea rows="2" class="form-control" id="itemDescription" readonly>{{ $requestedItem->item_description }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Canvass items with improved grid system -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @foreach ($requestedItem->requestedItemAttachments as $index => $itemAttachment)
                <div class="col">
                    <div class="card h-100">
                        <div
                            class="card-header d-flex justify-content-between align-items-center {{ $itemAttachment->is_selected == 1 ? 'bg-success text-white' : '' }}">
                            <h5 class="card-title mb-0">
                                Canvass {{ $loop->iteration }}
                                @if ($itemAttachment->is_selected == 1)
                                    <span class="badge bg-light text-success ms-2">Selected</span>
                                @endif
                            </h5>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-more-horizontal align-middle {{ $itemAttachment->is_selected == 1 ? 'text-white' : '' }}">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#"
                                        onclick="openFullScreen('pdfViewer-{{ $loop->index }}')"><i
                                            class="fas fa-expand"></i> Full Screen</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" value="{{ $itemAttachment->company_name }}"
                                    readonly>
                            </div>
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Contact</label>
                                        <input type="text" class="form-control"
                                            value="{{ $itemAttachment->company_contact_no }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control text-end"
                                            value="{{ $itemAttachment->item_price ? Number::currency($itemAttachment->item_price, 'PHP') : '' }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Responsive PDF viewer -->
                            <div class="ratio ratio-4x3 mt-3 position-relative">
                                @if ($itemAttachment->file_path)
                                    <iframe id="pdfViewer-{{ $loop->index }}"
                                        src="{{ asset('storage/' . $itemAttachment->file_path) }}" frameborder="0"
                                        class="w-100 h-100">
                                    </iframe>
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light">
                                        <p class="text-muted">No PDF available.</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="updateRequestedItemStatusModal" tabindex="-1" role="dialog"
        aria-labelledby="updateRequestedItemStatusModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Approval Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addNewItemFromRequest') }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">

                        <input type="text" hidden name="updateRequestedItemStatusId" id="updateRequestedItemStatusId"
                            value="{{ $requestedItem->id }}">
                        <div class="col-12 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="addRequestedItemToItemListStatus"
                                id="addRequestedItemToItemListStatus" required
                                onchange="toggleCommentSection(this.value)">
                                <option value="" selected disabled @readonly(true)>Select Status</option>
                                <option value="1">Approve ✔</option>
                                <option value="2">Disapprove X</option>
                            </select>
                        </div>
                        <div class="itemDetail" id="itemDetail" style="display: none;">
                            <div class="col-12 mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="addRequestedItemToItemListName"
                                    name="addRequestedItemToItemListName" value="{{ $requestedItem->item_name }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Item Description</label>
                                <textarea name="addRequestedItemToItemListDescription" id="addRequestedItemToItemListDescription"
                                    class="form-control">{{ $requestedItem->item_description }}</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Item Unit of Measure</label>
                                <input type="text" class="form-control" id="addRequestedItemToItemListUnitOfMeasure"
                                    name="addRequestedItemToItemListUnitOfMeasure"
                                    value="{{ $requestedItem->unit_of_measure }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Item Code</label>
                                <input type="text" class="form-control" id="addRequestedItemToItemListCode"
                                    name="addRequestedItemToItemListCode">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Select Item </label>
                                <select class="form-select" style="width: 100%"
                                    name="addRequestedItemToItemListAttachmentId"
                                    id="addRequestedItemToItemListAttachmentId" required>
                                    <option value="" selected disabled @readonly(true)>Select Item According to
                                        the submitted Canvasses</option>
                                    @foreach ($requestedItem->requestedItemAttachments as $attachment)
                                        <option value="{{ $attachment->id }}">{{ $requestedItem->item_name }}
                                            from {{ $attachment->company_name }} |
                                            {{ Number::currency($attachment->item_price, 'PHP') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Item Price</label>
                                <input type="text" class="form-control price-input-mask"
                                    id="addRequestedItemToItemListPrice" name="addRequestedItemToItemListPrice">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Item Category</label>
                                <select class="form-select select2" style="width: 100%"
                                    name="addRequestedItemToItemListCategory" id="addRequestedItemToItemListCategory"
                                    required>
                                    <option value="" selected disabled @readonly(true)>Select Item Category
                                    </option>
                                    @foreach ($itemCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->item_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Account Code</label>
                                <select class="form-select select2" style="width: 100%"
                                    name="addRequestedItemToItemListAccountCode"
                                    id="addRequestedItemToItemListAccountCode" required>
                                    <option value="" selected disabled @readonly(true)>Select Account Code</option>
                                    @foreach ($accountCodes as $code)
                                        <option value="{{ $code->id }}">{{ $code->account_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Is Available</label>
                                        <select class="form-select" name="addRequestedItemToItemListAvail"
                                            id="addRequestedItemToItemListAvail" required>
                                            <option value="" selected disabled @readonly(true)>Select Availability
                                                Status
                                            </option>
                                            <option value="1">Yes ✔</option>
                                            <option value="0">No X</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Is PSDBM</label>
                                        <select class="form-select" name="addRequestedItemToItemListPSDBM"
                                            id="addRequestedItemToItemListPSDBM" required>
                                            <option value="" selected disabled @readonly(true)>Select PSDBM Status
                                            </option>
                                            <option value="1">Yes ✔</option>
                                            <option value="0">No X</option>
                                        </select>
                                    </div>
                                </div>
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
    <script>
        function openFullScreen(id) {
            let iframe = document.getElementById(id);
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.mozRequestFullScreen) { // Firefox
                iframe.mozRequestFullScreen();
            } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari and Opera
                iframe.webkitRequestFullscreen();
            } else if (iframe.msRequestFullscreen) { // IE/Edge
                iframe.msRequestFullscreen();
            }
        }
    </script>


    <script>
        function updateRequestedItemStatusModal() {
            $('#updateRequestedItemStatusModal').modal('show');
        }

        function toggleCommentSection(value) {
            const itemDetailSection = document.getElementById('itemDetail');

            if (value === '1') {
                itemDetailSection.style.display = 'block';

                // Make all fields in this section required
                const requiredFields = itemDetailSection.querySelectorAll('input[type="text"], textarea, select');
                requiredFields.forEach(field => {
                    field.setAttribute('required', 'required');
                });
            } else {
                itemDetailSection.style.display = 'none';

                // Remove required attribute when section is hidden
                const fields = itemDetailSection.querySelectorAll('input[type="text"], textarea, select');
                fields.forEach(field => {
                    field.removeAttribute('required');
                });
            }
        }
    </script>

    @push('styles')
        <style>
            /* Additional responsive styles */
            @media (max-width: 576px) {
                .card-header {
                    padding: 0.75rem;
                }

                .form-label {
                    font-size: 0.9rem;
                }

                .ratio-4x3 {
                    --bs-aspect-ratio: 100%;
                    /* Make square on very small screens */
                }
            }
        </style>
    @endpush
@endsection
