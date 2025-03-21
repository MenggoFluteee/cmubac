@extends('layouts.app')

@section('title', 'Items')
@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Requested Items</h1>
            </div>
        </div>



        <div class="container-fluid p-0">
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon">
                        <i class="far fa-fw fa-square-exclamation"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Note!</strong> This page will enable your Department, Office, or Unit to request an item you
                        want to procure but currently not on the list of items. Once you submit your request, you cannot
                        edit the details anymore and wait for the office in-charge to respond. You can delete your request
                        so long as it has not be approved or disapproved.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-success" id="requestNewItemButton">
                                <i data-lucide="plus" class="lucide lucide-plus"></i> Request new item
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="requestedItemTable" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Item Description</th>
                                            <th>Approval Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be populated by JavaScript -->

                                        @foreach ($requestedItems as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->item_name }}
                                                </td>
                                                <td>
                                                    {{ $item->item_description }}
                                                </td>
                                                <td>
                                                    @if ($item->approval_status == 0)
                                                        <span class="badge bg-warning">Pending Request</span>
                                                    @elseif ($item->approval_status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif ($item->approval_status == 2)
                                                        <span class="badge bg-danger">Disapproved</span>
                                                    @else
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('endUserViewRequestedItemDetails', $item->id) }}"><button
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fas fa-eye"></i></button></a>
                                                    @if (!$item->approval_status == 1 || !$item->approval_status == 2)
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="deleteRequestedItem({{ $item->id }}, '{{ $item->item_name }}')"><i
                                                                class="fas fa-trash"></i></button>
                                                    @endif
                                                </td>
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
    </div>

    <div class="modal fade" id="requestNewItemModal" tabindex="-1" role="dialog" aria-labelledby="requestNewItemModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="requestNewItemForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Step progress indicator -->
                        <div class="mb-4 px-3">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">Step 1 of 4</div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="step-label active">Item Details</span>
                                <span class="step-label">Canvass 1</span>
                                <span class="step-label">Canvass 2</span>
                                <span class="step-label">Canvass 3</span>
                            </div>
                        </div>

                        <!-- Step 1: Item Details -->
                        <div class="step-content" id="step1Content">
                            <div class="card">

                                <div class="card-header text-center">
                                    <strong>
                                        <h4>Item Details</h4>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            <strong>Note!</strong> All fields marked with <span style="color: red">*</span>
                                            are
                                            required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="formRequestNewItemName"
                                            name="formRequestNewItemName" placeholder="Input Item Name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item Description</label>
                                        <textarea name="formRequestNewItemDescription" id="formRequestNewItemDescription" cols="30" rows="3"
                                            class="form-control" placeholder="Input Item Description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Unit of Meausure <span class="text-muted">(Unit, Piece,
                                                Ream, Roll, Box, Etc.)</span> <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="formRequestNewItemUnitOfMeasure"
                                            name="formRequestNewItemUnitOfMeasure"
                                            placeholder="Input Item Unit of Measurement" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Company 1 -->
                        <div class="step-content" id="step2Content" style="display: none;">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>
                                        <h4>Canvass 1</h4>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            <strong>Note!</strong> Only Canvass Form in PDF Format can be uploaded and the
                                            file size is limited to 3MB.
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Company Name <span style="color: red">
                                                    *</span></label>
                                            <input type="text" class="form-control"
                                                id="formRequestNewItemCompanyName1" name="formRequestNewItemCompanyName1"
                                                placeholder="Input Company Name" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Company Contact<span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control phone-mask"
                                                id="formRequestNewItemCompanyContact1"
                                                name="formRequestNewItemCompanyContact1" placeholder="09XX XXX XXXX"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item Price <span style="color: red"> *</span></label>
                                        <input type="text" class="form-control price-input-mask"
                                            id="formRequestNewItemCanvasForm1Price"
                                            name="formRequestNewItemCanvasForm1Price"
                                            placeholder="Enter Canvassed Price Here" required>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Upload Canvas Form <span style="color: red">
                                                *</span></label>
                                        <input type="file" class="form-control" id="formRequestNewItemCanvasForm1File"
                                            name="formRequestNewItemCanvasForm1File" placeholder="In PDF Format only"
                                            accept=".pdf,application/pdf" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Company 2 -->
                        <div class="step-content" id="step3Content" style="display: none;">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>
                                        <h4>Canvass 2</h4>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            <strong>Note!</strong> Only Canvass Form in PDF Format can be uploaded and the
                                            file size is limited to 3MB.
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Company Name <span style="color: red">
                                                    *</span></label>
                                            <input type="text" class="form-control"
                                                id="formRequestNewItemCompanyName2" name="formRequestNewItemCompanyName2"
                                                placeholder="Input Company Name" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Company Contact<span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control phone-mask"
                                                id="formRequestNewItemCompanyContact2"
                                                name="formRequestNewItemCompanyContact2" placeholder="09XX XXX XXXX"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item Price <span style="color: red"> *</span></label>
                                        <input type="text" class="form-control price-input-mask"
                                            id="formRequestNewItemCanvasForm2Price"
                                            name="formRequestNewItemCanvasForm2Price"
                                            placeholder="Enter Canvassed Price Here" required>

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Upload Canvas Form <span style="color: red">
                                                *</span></label>
                                        <input type="file" class="form-control" id="formRequestNewItemCanvasForm2File"
                                            name="formRequestNewItemCanvasForm2File" placeholder="In PDF Format only"
                                            accept=".pdf,application/pdf" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Company 3 -->
                        <div class="step-content" id="step4Content" style="display: none;">
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong>
                                        <h4>Canvass 3</h4>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            <strong>Note!</strong> Only Canvass Form in PDF Format can be uploaded and the
                                            file size is limited to 3MB.
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label class="form-label">Company Name <span style="color: red">
                                                    *</span></label>
                                            <input type="text" class="form-control"
                                                id="formRequestNewItemCompanyName3" name="formRequestNewItemCompanyName3"
                                                placeholder="Input Company Name" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Company Contact<span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control phone-mask"
                                                id="formRequestNewItemCompanyContact3"
                                                name="formRequestNewItemCompanyContact3" placeholder="09XX XXX XXXX"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item Price <span style="color: red"> *</span></label>
                                        <input type="text" class="form-control price-input-mask"
                                            id="formRequestNewItemCanvasForm3Price"
                                            name="formRequestNewItemCanvasForm3Price"
                                            placeholder="Enter Canvassed Price Here" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Upload Canvas Form <span
                                                style="color: red">*</span></label>
                                        <input type="file" class="form-control" id="formRequestNewItemCanvasForm3File"
                                            name="formRequestNewItemCanvasForm3File" placeholder="In PDF Format only"
                                            accept=".pdf,application/pdf" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <!-- First step shows Cancel button on left side -->
                                <button type="button" class="btn btn-light" id="cancelBtn"
                                    data-bs-dismiss="modal">Cancel</button>

                                <!-- Other steps show Previous button on left side -->
                                <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                                    <i class="fas fa-chevron-left me-1"></i> Previous
                                </button>
                            </div>
                            <div>
                                <!-- All but last step show Next button -->
                                <button type="button" class="btn btn-primary" id="nextBtn">
                                    Next <i class="fas fa-chevron-right ms-1"></i>
                                </button>

                                <!-- Last step shows Submit button -->
                                <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                                    <i class="fas fa-save me-1"></i> Create Form
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- STEP BY STEP MODAL FOR ITEM REQUEST --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalSteps = 4;
            let currentStep = 1;

            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const submitBtn = document.getElementById('submitBtn');
            const progressBar = document.querySelector('.progress-bar');
            const stepLabels = document.querySelectorAll('.step-label');

            // Function to show the current step
            function showStep(step) {
                // Hide all steps
                document.querySelectorAll('.step-content').forEach(stepContent => {
                    stepContent.style.display = 'none';
                });

                // Show the current step
                document.getElementById(`step${step}Content`).style.display = 'block';

                // Update progress bar
                const progressPercentage = (step / totalSteps) * 100;
                progressBar.style.width = `${progressPercentage}%`;
                progressBar.textContent = `Step ${step} of ${totalSteps}`;
                progressBar.setAttribute('aria-valuenow', progressPercentage);

                // Update step labels
                stepLabels.forEach((label, index) => {
                    if (index < step) {
                        label.classList.add('active');
                    } else {
                        label.classList.remove('active');
                    }
                });

                // Show/hide buttons based on current step
                const cancelBtn = document.getElementById('cancelBtn');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const submitBtn = document.getElementById('submitBtn');

                if (step === 1) {
                    // First step: Show Cancel on left, Next on right
                    cancelBtn.style.display = 'block';
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'block';
                    submitBtn.style.display = 'none';
                } else if (step === totalSteps) {
                    // Last step: Show Previous on left, Submit on right
                    cancelBtn.style.display = 'none';
                    prevBtn.style.display = 'block';
                    nextBtn.style.display = 'none';
                    submitBtn.style.display = 'block';
                } else {
                    // Middle steps: Show Previous on left, Next on right
                    cancelBtn.style.display = 'none';
                    prevBtn.style.display = 'block';
                    nextBtn.style.display = 'block';
                    submitBtn.style.display = 'none';
                }
            }

            // Next button click handler
            nextBtn.addEventListener('click', function() {
                // Simple validation for required fields in current step
                const currentStepContent = document.getElementById(`step${currentStep}Content`);
                const requiredFields = currentStepContent.querySelectorAll('[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (!field.value) {
                        valid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (valid && currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            // Previous button click handler
            prevBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Form submission handling
            document.getElementById('requestNewItemForm').addEventListener('submit', function(event) {
                // You can add final validation here if needed
                // If validation fails, prevent form submission
                // event.preventDefault();
            });

            // Initialize the first step
            showStep(1);

            // Add styles for the step labels
            const style = document.createElement('style');
            style.textContent = `
                .step-label {
                    color: #6c757d;
                    font-size: 0.85rem;
                }
                .step-label.active {
                    color: #0d6efd;
                    font-weight: bold;
                }
                .is-invalid {
                    border-color: #dc3545;
                }
            `;
            document.head.appendChild(style);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#requestedItemTable').DataTable({
                "paging": true,
                "pageLength": 8,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,
            }).buttons().container().appendTo('#requestedItemTable_wrapper .col-md-6:eq(0)');

        });

        $('#requestNewItemButton').click(function() {
            $('#requestNewItemModal').modal('show');
        });

        $('#requestNewItemForm').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Once this request is submitted, you cannot edit it anymore.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a FormData object to properly handle file uploads
                    let formData = new FormData(this);

                    // Clean and add price values
                    for (let i = 1; i <= 3; i++) {
                        let priceId = `formRequestNewItemCanvasForm${i}Price`;
                        let priceVal = $(`#${priceId}`).val();
                        priceVal = priceVal.replace(/[₱,\s]/g, '');
                        priceVal = parseFloat(priceVal);

                        formData.set(priceId, priceVal);
                    }

                    $.ajax({
                        url: "{{ route('addNewRequestedItem') }}",
                        type: 'POST',
                        data: formData,
                        processData: false, // Important for file uploads
                        contentType: false, // Important for file uploads
                        dataType: 'json',
                        success: function(response) {
                            $('#requestNewItemForm')[0].reset();
                            $('#requestNewItemModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message
                            }).then(() => {
                                location.reload();
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


        function deleteRequestedItem(id, itemName) {
            Swal.fire({
                title: 'Are you sure you want to delete this requested item?',
                text: `${itemName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#02681e',
                cancelButtonColor: 'd33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('endUserDeleteRequestedItem') }}", // URL is static
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            requestedItemId: id, // Send the ID via POST data
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', `${response.message}`, 'success').then(() => {
                                    location.reload();
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }
    </script>
@endsection
