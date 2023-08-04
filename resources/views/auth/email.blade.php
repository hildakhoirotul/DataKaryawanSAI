<!DOCTYPE html>
<html>

<head>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .container {
            padding: 10px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .container h3 {
            margin-bottom: 10px;
        }

        .container .bx {
            font-size: 100px;
            color: #b5b5b5;
            margin-bottom: 10px;
        }
    </style>
    <title>Pessword Anda</title>
</head>

<body>
    <div class="container">
        <h3>[Lupa Password] - Berikut NIK dan Password Anda</h3>
        <i class='bx bx-user-pin'></i>
        <p>Silahkan login kembali dengan NIK 6 digit dan password anda.</p>
        <p>NIK: {{ $user->nik }}</p>
        <p>Password : {{ $user->chain }}</p>
        <p>Pastikan untuk selalu mengingat password anda dan menjaga privasi NIK anda.</p>
    </div>
</body>

</html>