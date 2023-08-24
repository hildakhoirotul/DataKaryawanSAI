<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Homepage</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1><a href="{{ route('home') }}"><span>Home</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li class="dropdown"><a href="#"><span class="nik">{{ Auth::user()->nik }}</span><i class="bi bi-person-circle" style="font-size: 30px;"></i></a>
                        <ul>
                            <li><a href="{{ route('change-password') }}"><span><i class="bi bi-house-lock-fill"></i>Ganti Sandi</span></a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span><i class="bi bi-door-open-fill"></i>{{ __('Keluar') }}</span></a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    @yield('content')

    <script src="{{ asset('assets/vendor/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>