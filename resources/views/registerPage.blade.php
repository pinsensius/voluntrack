<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="garis"></div>
            <div class="col-8 d-flex justify-content-center align-items-center">
                <img src="../image/register.svg" alt="login">
            </div>
            <div class="col-4 input-form px-5">
                <div class="welcome mt-5 d-flex justify-content-center align-items-center me-5">
                    <img src="../icon/1.svg" alt="logo" width="50px">
                    <h5>Selamat Datang !</h5>
                </div>
                <p class="text-center" style="font-size: .8em;">Silahkan Isi Data Anda</p>
                <div class="input d-flex flex-column">
                    <form action="register.php" method="POST">
                        <label for="username">Nama Pengguna <span>*</span></label>
                        <input type="text" class="form-control" id="usernameField" name="username" maxlength="80" placeholder="Masukkan nama pengguna">
                        <label for="email">Email <span>*</span></label>
                        <input type="email" class="form-control" id="emailField" aria-describedby="emailField" name="email"
                    maxlength="255" placeholder="Masukkan email">
                        <label for="password">Kata Sandi <span>*</span></label>
                        <input type="password" class="form-control" id="passwordField" name="password" placeholder="Masukkan kata sandi">

                        <button type="submit" class="mt-4" name="daftar" value="ADD RECORD">Daftar</button>
                    </form>
                    
                </div>
                <p>Sudah punya akun? <a href="{{ route('loginPage') }}">Masuk</a></p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>