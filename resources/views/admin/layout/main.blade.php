<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
    <link href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}" rel="stylesheet">


    <!-- <link rel="stylesheet" href="css/app.css" /> -->
</head>

<body>
    <!-- navbar -->
    @include('admin.layout.navbar')
    @include('sweetalert::alert')

    <!-- sidebar -->
    <!-- <div class="container-fluid"> -->
    @include('admin.layout.sidebar')

    <main class="content p-2 pt-5">
        @yield('content')
    </main>

    <!-- </div> -->

    <!-- JavaScript -->
    <script src="js/script.js"></script>
    <script src="{{ asset('js/jquery.min.css') }}"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('css/style.css') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
    <script>
        function togglePasswordVisibility(icon) {
            var passwordInput = icon.previousElementSibling; // Mendapatkan elemen sebelumnya (input password)
            var type = passwordInput.getAttribute('type'); // Mendapatkan atribut type dari input

            if (type === 'password') {
                passwordInput.setAttribute('type', 'text'); // Ganti atribut type menjadi 'text' untuk menampilkan teks
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.setAttribute('type', 'password'); // Ganti atribut type menjadi 'password' untuk menyembunyikan teks
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>


    <!-- <script src="js/app.js"></script> -->
</body>

</html>