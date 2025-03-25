<!DOCTYPE html>

<html lang="en" data-layout="fluid" data-sidebar-theme="colored" data-sidebar-position="left"
    data-sidebar-behavior="sticky" data-bs-theme="light">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>ProcureNet | @yield('title')</title>
    

    <link rel="shortcut icon" href="{{ asset('images/cmulogo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <link href="{{ asset('appstack-assets/css/app.css') }}" rel="stylesheet">


    {{-- Include jQuery First --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    {{-- Include Select2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

    {{-- Other plugin CSS and JS --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-pro/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- Ensure jQuery is loaded first before other JS --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.js') }}"></script>


    <style>
        /* Basic styles */
        .sidebar .animated-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            /* Adjust as needed */
        }

        /* Animated Logo "P" Styles */
        .sidebar .animated-logo .logo {
            font-size: 2rem;
            /* Adjust the size */
            font-weight: bold;
            color: #3498db;
            /* Change color as needed */
            position: relative;
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Dot for the "P" */
        .sidebar .animated-logo .logo::before {
            content: "";
            position: absolute;
            width: 0.5rem;
            height: 0.5rem;
            background-color: #3498db;
            border-radius: 50%;
            top: 0.7rem;
            left: 0.5rem;
            animation: dotGrow 1.5s ease-in-out infinite;
        }

        /* Keyframes for pulse animation */
        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Keyframes for the dot animation */
        @keyframes dotGrow {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.7;
            }
        }
    </style>

    {{-- STYLE FOR THE SELECT2 SO THAT THE SEARCH AREA FLEXES ACROSS THE ENTIRE WIDTH OF THE PARENT CONTAINER --}}
    <style>
        .select2-container .select2-search--dropdown .select2-search__field {
            width: 100% !important;
            /* Ensures the search field takes up the full width */
            box-sizing: border-box;
            /* Ensures padding and borders are included in the width */
        }
    </style>


</head>

<body>
    <div class="wrapper">


        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class='sidebar-brand' href='index.html'>
                    <img src="{{ asset('images/cmulogo.png') }}" class="img-fluid rounded-circle me-1 mt-n2 mb-n2"
                        alt="Chris Wood" width="40" height="40" />
                    <span class="align-middle me-3" id="procurenet-title">ProcureNet</span>
                </a>
                @include('layouts.navigation')

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-bg">
                <a class="sidebar-toggle">
                    <i class="hamburger align-self-center text-gray-900"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">




                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-lucide="settings"></i>
                            </a>

                            @if (Auth::user()->sex == 1)
                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                    data-bs-toggle="dropdown">
                                    <img src="{{ asset('images/maleProfile.png') }}"
                                        class="img-fluid rounded-circle me-1 mt-n2 mb-n2" alt="User Image"
                                        width="40" height="40" /> <span>{{ Auth::user()->firstname }}</span>
                                </a>
                            @elseif (Auth::user()->sex == 0)
                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                    data-bs-toggle="dropdown">
                                    <img src="{{ asset('images/femaleProfile.png') }}"
                                        class="img-fluid rounded-circle me-1 mt-n2 mb-n2" alt="User Image"
                                        width="40" height="40" /> <span>{{ Auth::user()->firstname }}</span>
                                </a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-end">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="align-middle me-1" data-lucide="pie-chart"></i> Logout
                                    </a>
                                </form>



                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                {{-- Loading Spinner Overlay --}}
                <div id="loadingIndicator" class="position-fixed w-100 h-100"
                    style="display: none; top: 0; left: 0; background-color: rgba(0, 0, 0, 0.3); z-index: 9999;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                        <div class="row">
                            {{-- Loading Spinners --}}
                            <div class="spinner-grow ml-1" style="color: #ffc600">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1 text-warning">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1" style="color: #919f02">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1" style="color: #02681e">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1" style="color: #00491e">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            CENTRAL MINDANAO UNIVERSITY | Software Development Department
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                &copy; 2024 - <a class='text-muted' href='cmu.edu.ph'>CMU</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('appstack-assets/js/app.js') }}"></script>

    {{-- Input field contact information philippines format masking --}}
    <script>
        document.querySelectorAll('.phone-mask').forEach(function(input) {
            $(input).inputmask({
                mask: '0\\999 999 9999',
                placeholder: '09XX XXX XXXX',
                clearMaskOnLostFocus: false,
                removeMaskOnSubmit: true,
                showMaskOnHover: false,
                definitions: {
                    '9': {
                        validator: '[0-9]',
                        cardinality: 1
                    }
                }
            });
        });
    </script>

    {{-- Price Formatting Input Mask --}}
    <script>
        document.querySelectorAll('.price-input-mask').forEach(function(input) {
            $(input).inputmask({
                alias: 'numeric',
                groupSeparator: ',',
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                prefix: '₱', // You can use any currency symbol here
                placeholder: '0',
                rightAlign: true,
                removeMaskOnSubmit: true // Optional, removes mask when form is submitted
            });
        });
    </script>

    <script>
        function showLoadingIndicator() {
            $('#loadingIndicator').show();
        }

        // Function to hide loading indicator
        function hideLoadingIndicator() {

            $('#loadingIndicator').hide();

        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select2
            $(".select2").each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
        });
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Retrieve the validation errors from the PHP code
                const errors = @json($errors->all());

                // Format errors as an unordered list with centered text
                let errorList = `
            <ul style="list-style: none; padding: 0; margin: 0; text-align: center; color: #dc3545;">
                ${errors.map(error => `<li style="margin-bottom: 10px;">${error}</li>`).join('')}
            </ul>
        `;

                // Display the errors using SweetAlert
                Swal.fire({
                    title: 'Error!',
                    html: errorList, // Use 'html' property to insert HTML content
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#02681e',
                    customClass: {
                        title: 'swal-title',
                        content: 'swal-content',
                        confirmButton: 'swal-confirm',
                        confirmButtonColor: '#00491e'
                    }
                });
            });
        </script>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: "{{ Session::get('message') }}",
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#02681e',
                    customClass: {
                        title: 'swal-title',
                        content: 'swal-content',
                        confirmButton: 'swal-confirm',
                        confirmButtonColor: '#00491e'
                    }
                });
            @elseif (Session::has('error'))
                Swal.fire({
                    title: 'Error!',
                    icon: 'error',
                    text: "{{ Session::get('error') }}",
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red',
                    customClass: {
                        title: 'swal-title',
                        content: 'swal-content',
                        confirmButton: 'swal-confirm',
                        confirmButtonColor: 'red'
                    }
                });
            @endif
        });
    </script>

    @yield('scripts')


</body>

</html>
