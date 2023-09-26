<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"> -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">

</head>

<body>
    @include('sweetalert::alert')
    @yield('content')
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