@extends('layouts.app')

@section('title', 'Requested Item Details Page')

@section('content')
    <div class="container-fluid p-0">
        <!-- Responsive header -->
        <div class="row mb-2 mb-xl-3">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h3 class="text-center text-sm-start mb-0">Requested Item Details</h3>

                    <div class="ms-3">
                        @if ($requestedItem->approval_status == 0)
                            <span class="badge bg-warning">Pending</span>
                        @elseif($requestedItem->approval_status == 1)
                            <span class="badge bg-success">Approved</span>
                        @elseif($requestedItem->approval_status == 2)
                            <span class="badge bg-danger">Disapproved</span>
                        @endif
                    </div>
                </div>
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
                        <div class="card-header d-flex justify-content-between align-items-center {{ $itemAttachment->is_selected == 1 ? 'bg-success text-white' : '' }}">
                            <h5 class="card-title mb-0">
                                Canvass {{ $loop->iteration }}
                                @if($itemAttachment->is_selected == 1)
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
                                    <a class="dropdown-item"
                                        href="#" onclick="openFullScreen('pdfViewer-{{ $loop->index }}')"><i
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
@endsection
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
