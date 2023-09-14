<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Masuk</title>
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

</head>

<body>
    <div class="container">
        @include('sweetalert::alert')
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" action="{{ route('login') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Masuk</h2>

                    <div class="input-field">
                        <i class="bi bi-person-vcard"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                    </div>
                    <div class="remember">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn solid fw-bold">
                        {{ __('Masuk') }}
                    </button>
                    <!-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif -->
                    <a href="{{ route('lupa-password') }}" class="lupa-password">Lupa Password?</a>
                    <!-- @if (Route::has('password.request')) -->
                    <!-- <a href="{{ route('password.request') }}">
                        {{ __('Reset Password') }}
                    </a>
                    @endif -->
                </form>
                <form method="POST" action="{{ route('register') }}" class="sign-up-form">
                    @csrf
                    <h2 class="title">Daftar</h2>
                    <div class="input-field">
                        <i class="bi bi-person-vcard"></i>
                        <input type="text" id="nik1" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" id="nama" data-id="nama" placeholder="Nama" class="form-control @error('nik') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" id="email" data-id="email" placeholder="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password1" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                    </div>
                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password_confirmation" type="password" placeholder="Konfirmasi Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
                        <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                    </div>

                    <button type="submit" class="btn solid fw-bold">
                        {{ __('Daftar') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Selamat Datang</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit dan password anda untuk Masuk.
                    </p>
                    <p>Belum punya akun?</p>
                    <button class="btn transparent" id="sign-up-btn">
                        Daftar
                    </button>
                </div>
                <img src="{{ asset('assets/img/register.svg') }}" class="image" alt="Register" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Selamat Datang</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit, password, dan konfirmasi password untuk Mendaftar.
                    </p>
                    <p>Sudah punya akun?</p>
                    <button class="btn transparent" id="sign-in-btn">
                        Masuk
                    </button>
                </div>
                <img src="{{ asset('assets/img/login.svg') }}" class="image" alt="Login" />
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script> -->
    <script src="{{ asset('js/login.js') }}" defer></script>
    <script>
        function togglePasswordVisibility(icon) {
            var passwordInput = icon.previousElementSibling;
            var type = passwordInput.getAttribute('type');

            if (type === 'password') {
                passwordInput.setAttribute('type', 'text');
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            } else {
                passwordInput.setAttribute('type', 'password');
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            }
        }
    </script>
</body>

</html>