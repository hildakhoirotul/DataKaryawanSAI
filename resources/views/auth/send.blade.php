@extends('auth.main')
@section('content')
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup text-center">
                <form method="POST" action="{{ route('lupaPassword') }}" class="sign-up-form" style="margin-top: 30px;">
                    @csrf
                    <h2 class="title">Lupa Password</h2>
                    <div class="input-field">
                        <i class="bi bi-person-vcard"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="Masukkan NIK 6 digit" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="bi bi-envelope-fill"></i>
                        <input id="email" type="email" placeholder="Masukkan Email anda" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="current_email">
                    </div>
                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password" type="password" placeholder="Password awal anda" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn me-1">
                            {{ __('Submit') }}
                        </button>
                        <a href="{{ route('login') }}"><button type="button" class="btn-cancel ms-1">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel"></div>
            <div class="panel right-panel" style="margin-top: 0;">
                <div class="circle"></div>
                <div class="content px-1 text-center">
                    <h3 style="margin-bottom: 20px;">Lupa Password Anda?</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit, Email dan Password awal anda. Password awal merupakan password pertama yang diberikan kepada anda.
                    </p>
                </div>
                <img src="{{ asset('assets/img/login.svg') }}" class="image" alt="Login" />
            </div>
        </div>
    </div>
@endsection