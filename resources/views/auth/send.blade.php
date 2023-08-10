<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/login.css') }}" rel="stylesheet"> -->
    <title>Get Password</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">
    
</head>

<body>
    <div class="container">
        @include('sweetalert::alert')
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" action="{{ route('lupa-password') }}" class="sign-up-form">
                    @csrf
                    <h2 class="title">Lupa Password</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="input-field">
                        <!-- <i class="fas fa-envelope"></i> -->
                        <i class="fa-regular fa-address-card"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="Masukkan NIK 6 digit" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <!-- <i class="fas fa-lock"></i> -->
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" placeholder="Masukkan Email anda" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="current_email">
                    </div>
                    <!-- <a href="send-email">send</a> -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn">
                            {{ __('Get Password') }}
                        </button>
                        <a href="{{ url()->previous() }}"><button type="button" class="btn-cancel btn-outline-secondary" href="{{ url()->previous() }}">Cancel</button></a>
                    </div>

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Lupa Password Anda?</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit dan Email anda.
                    </p>
                </div>
                <img src="assets/img/login.svg" class="image" alt="Login" />
            </div>
        </div>
    </div>
    <script src="{{ asset('js/login.js') }}" defer></script>
</body>

</html>