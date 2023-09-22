<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/login1.css') }}" rel="stylesheet">
    <title>Masuk</title>
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">

</head>

<body>
    @include('sweetalert::alert')
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup text-center">
                <form method="POST" action="{{ route('lupaPassword') }}" class="sign-up-form ">
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
            <div class="panel right-panel justify-content-center">
                <div class="circle"></div>
                <div class="content px-1 text-center">
                    <h3>Lupa Password Anda?</h3>
                    <p>
                        Silahkan masukkan NIK 6 digit, Email dan Password awal anda. Password awal merupakan password pertama yang diberikan kepada anda.
                    </p>
                </div>
                <img src="{{ asset('assets/img/login.svg') }}" class="image" alt="Login" />
            </div>
        </div>
    </div>
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
    <script>
        const circle = document.querySelector('.circle');
        const content = document.querySelector('.content');

        circle.addEventListener('animationend', () => {
            setTimeout(() => {
                content.style.opacity = '1';
            }, 300);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const signinSignup = document.querySelector('.signin-signup');
            signinSignup.style.transform = 'translateY(0)';
        });
    </script>
</body>

</html>