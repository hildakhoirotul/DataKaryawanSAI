<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="#" class="sign-up-form">
                    <h2 class="title">Ganti Password</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Konfirmasi Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn solid fw-bold">
                        {{ __('GANTI') }}
                    </button>
                </form>
                <form method="POST" action="{{ route('login') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Login</h2>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Konfirmasi Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>

                    <button type="submit" class="btn solid fw-bold">
                        {{ __('GANTI') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Selamat Datang</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit dan password anda untuk Login.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Ganti
                    </button>
                </div>
                <img src="assets/img/register.svg" class="image" alt="Register" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Ingin Ganti Password?</h3>
                    <p>
                        Silahkan masukkan NIK 2 digit, password dan konfirmasi password.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Masuk
                    </button>
                </div>
                <img src="assets/img/login.svg" class="image" alt="Login" />
            </div>
        </div>
    </div>
    <script src="{{ asset('js/login.js') }}" defer></script>
</body>

</html>