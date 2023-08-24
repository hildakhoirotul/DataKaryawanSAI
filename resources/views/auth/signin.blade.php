<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/login.css') }}" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css" rel="stylesheet"> -->
    <!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <title>Masuk</title>
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

</head>

<body>
    <div class="container">
        @include('sweetalert::alert')
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" action="{{ route('sign-in') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Masuk</h2>

                    <div class="input-field">
                        <!-- <i class='bx bx-id-card'></i> -->
                        <i class="fa-regular fa-address-card"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <!-- <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div> -->
                    <!-- <a href="#" class="href">Lupa Password :(</a> -->

                    <button type="submit" class="btn solid fw-bold">
                        {{ __('Masuk') }}
                    </button>
                    <!-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif -->
                    <!-- <a href="{{ url('lupa-password') }}" class="lupa-password">Lupa Password?</a> -->
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel" style="align-items: center;">
                <div class="content">
                    <h3>Selamat Datang</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit anda untuk Masuk.
                    </p>
                    <!-- <button class="btn transparent" id="sign-up-btn">
                        Daftar
                    </button> -->
                </div>
                <img src="{{ asset('assets/img/register.svg') }}" class="image" alt="Register" />
            </div>
            <!-- <div class="panel right-panel">
                <div class="content">
                    <h3>Hesabınız var?</h3>
                    <p>
                        Mağazamızdakı məhsullardan sifariş vermək üçün daxil olmağınız şərtdir.
                        Daxil olmağa tələsin..
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Masuk
                    </button>
                </div>
                <img src="assets/img/login.svg" class="image" alt="Login" />
            </div> -->
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script> -->
    <!-- <script src="js/login.js" defer></script> -->


</body>

</html>