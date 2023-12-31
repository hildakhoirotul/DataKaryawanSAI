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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Homepage</title>
    <link href="{{ asset('css/karyawan.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/karyawan.css') }}"> -->
    <!-- <link href="{{ asset('css/karyawan.css') }}?v={{ filemtime(public_path('css/karyawan.css')) }}" rel="stylesheet"> -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">

</head>

<body>

    <!-- navbar -->
    <nav class="navbar pe-0">
        <div class="logo_item">
        </div>

        <div class="navbar_content">
            <i class='bx bx-sun' id="darkLight"></i>
            <div class="dropdown">
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span>{{ Auth::user()->nik }}</span>
                    <img src="{{ asset('assets/img/account.png') }}" class="img" alt="">
                </a>
                <div class="dropdown-menu pe-0" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('change-password') }}">
                        <i class="fa-solid fa-key"></i>
                        <span>Ganti Sandi</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>{{ __('Keluar') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar end -->
    @include('sweetalert::alert')

    @yield('content')

    <!-- </div> -->
    <!-- <script>
        const body = document.querySelector("body");
        const darkLight = document.querySelector("#darkLight");
        const darkMode = localStorage.getItem("darkMode1");

        darkLight.addEventListener("click", () => {
            body.classList.toggle("dark");
            localStorage.setItem("darkMode1", "dark");
            if (body.classList.contains("dark")) {
                // document.setI
                darkLight.classList.replace("bx-sun", "bx-moon");
            } else {
                darkLight.classList.replace("bx-moon", "bx-sun");
                localStorage.setItem("darkMode1", "light")
            }
        });

        if (darkMode == "dark") {
            body.classList.toggle("dark");
            darkLight.classList.replace("bx-sun", "bx-moon");
        } else {
            darkLight.classList.replace("bx-moon", "bx-sun");
        }
    </script> -->

    <!-- JavaScript -->
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>