@extends('auth.main')
@section('content')
<div class="container">
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
                <!-- <div class="input-field">
                        <i class="fa-regular fa-address-card"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div> -->
                <div class="input-field">
                    <i class="bi bi-lock-fill"></i>
                    <input id="current_password" type="password" placeholder="Password Lama" class="form-control @error('password') is-invalid @enderror" name="current_password" required autocomplete="current_password">
                    <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                </div>
                <div class="input-field">
                    <i class="bi bi-lock-fill"></i>
                    <input id="new_password" type="password" placeholder="Password Baru" class="form-control @error('password') is-invalid @enderror" name="new_password" required autocomplete="new_password">
                    <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                </div>
                <div class="input-field">
                    <i class="bi bi-lock-fill"></i>
                    <input id="password_confirmation" type="password" placeholder="Konfirmasi Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation">
                    <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
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
                    @if(Auth::user()->is_admin)
                    <a href="{{ route('dashboard') }}">
                        @else
                        <a href="{{ route('home') }}">
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
            <img src="{{ asset('assets/img/login.svg') }}" class="image" alt="Login" />
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
@endsection