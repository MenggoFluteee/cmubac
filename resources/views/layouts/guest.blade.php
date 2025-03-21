<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProcureNet | @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('images/cmulogo.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

    <link href="{{ asset('appstack-assets/css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card">
            @yield('content')
        </div>
    </div>
    <!-- /.login-box -->

    <script src="{{ asset('appstack-assets/js/app.js') }}"></script>
</body>

</html>
