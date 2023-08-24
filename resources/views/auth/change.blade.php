<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/login.css') }}" rel="stylesheet"> -->
    <!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <title>Change Password</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">

</head>

<body>
    <div class="container">
        @include('sweetalert::alert')
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" action="{{ route('changePassword') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Ganti Password</h2>
                    <!-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif -->
                    <div class="input-field">
                        <!-- <i class="fas fa-envelope"></i> -->
                        <i class="fa-regular fa-address-card"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="current_password" type="password" placeholder="Password Lama" class="form-control @error('password') is-invalid @enderror" name="current_password" required autocomplete="current_password">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="new_password" type="password" placeholder="Password Baru" class="form-control @error('password') is-invalid @enderror" name="new_password" required autocomplete="new_password">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password_confirmation" type="password" placeholder="Konfirmasi Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation">
                    </div>
                    <!-- <button type="submit" class="btn solid fw-bold">
                        {{ __('GANTI') }}
                    </button>
                    <div class="mt-3">
                        <a href="{{ url()->previous() }}" class="btn solid fw-bold">Cancel</a>
                    </div> -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn">
                            {{ __('GANTI') }}
                        </button>
                        @if(Auth::user()->is_admin) <!-- Anda harus memiliki metode isAdmin() di model User yang memeriksa peran admin -->
                        <a href="{{ route('/dashboard') }}">
                            @else
                            <a href="{{ route('/home') }}">
                                @endif
                                <button type="button" class="btn-cancel btn-outline-secondary">Cancel</button>
                            </a>
                    </div>

                </form>
                <!-- <form method="POST" action="{{ route('login') }}" class="sign-in-form">
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
                        {{ __('login') }}
                    </button>
                </form> -->
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Ingin Ganti Password?</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit, password lama dan password baru.
                    </p>
                    <!-- <button class="btn transparent" id="sign-in-btn">
                        Masuk
                    </button> -->
                </div>
                <img src="assets/img/login.svg" class="image" alt="Login" />
                <!-- <div class="content">
                    <h3>Selamat Datang</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit dan password anda untuk Login.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Ganti
                    </button>
                </div>
                <img src="assets/img/register.svg" class="image" alt="Register" /> -->
            </div>
            <div class="panel right-panel">
                <!-- <div class="content">
                    <h3>Ingin Ganti Password?</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit, password lama dan password baru.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Masuk
                    </button>
                </div>
                <img src="assets/img/login.svg" class="image" alt="Login" /> -->
            </div>
        </div>
    </div>
    <script src="js/login.js" defer></script>
</body>

</html>