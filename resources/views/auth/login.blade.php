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
                <form method="POST" action="{{ route('login') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Masuk</h2>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" id="nik" data-id="nik" placeholder="NIK" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    <!-- <a href="#" class="href">Lupa Password :(</a> -->

                    <button type="submit" class="btn solid fw-bold">
                        {{ __('Masuk') }}
                    </button>
                    <!-- <input type="submit" value="Masuk" class="btn solid" /> -->
                    <!-- <p class="social-text">Sosial şəbəkələr vasitəsi ilə daxil ola bilərsiniz..</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> -->
                </form>
                <!-- <form action="#" class="sign-up-form">
                    <h2 class="title">Register</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Ad, Soyad" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="email" placeholder="Telefon" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="password" />
                    </div>
                    <div>
                        <input type="checkbox" /><a href="#" class="href"> <span class="rules-text">"Alıcı müqaviləsi"</a></span> nin şərtləri ilə razıyam
                    </div>

                    <input type="submit" class="btn" value="Qeydiyyatı tamamla" />
                    <p class="social-text">Sosial şəbəkələr vasitəsi ilə qeydiyyatdan keçə bilərsiniz..</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form> -->
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Selamat Datang</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit dan password anda untuk Login.
                    </p>
                    <!-- <button class="btn transparent" id="sign-up-btn">
                        Daftar
                    </button> -->
                </div>
                <img src="assets/img/register.svg" class="image" alt="Register" />
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
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>