<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <!-- Boxicons CSS -->
    <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <!-- <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}"> -->
    <title>@yield('title')</title>
    <!-- favicon -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    @livewireStyles
    <style>
        body.dark input.form-control {
            color: #ffffff !important;
            background: #333 !important;
        }

        body.dark input.form-control::placeholder {
            color: #ffffff !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- navbar -->
    @include('admin.layout.navbar')
    @include('sweetalert::alert')

    <!-- sidebar -->
    <!-- <div class="container-fluid"> -->
    @include('admin.layout.sidebar')

    @yield('content')

    <!-- </div> -->

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-5.3.0/js/bootstrap.min.js') }}"></script>
    <!-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
</body>

</html>