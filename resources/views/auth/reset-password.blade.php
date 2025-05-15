<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Page</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-4 input-form p-5">
                <!-- Logo dan judul -->
                <div class="logo d-flex pt-2 pb-2 align-items-center justify-content-center">
                    <img src="../icon/1.svg" alt="icon">
                    <h5>Voluntrack.</h5>
                </div>
                <div class="welcome mt-5 text-center">
                    <h5>Selamat Datang Kembali!</h5>
                    <p>Silahkan masukan email anda</p>
                </div>
                <!-- Form Reset password -->
                <form method="POST" action="{{ route('password.update.procedure') }}">
                    @csrf
                    <!-- Kode input -->
                    <label for="kode" class="mb-1">Kode</label>
                    <input type="text" class="form-control mb-4" id="kode" name="kode" value="{{ old('kode') }}" required autofocus placeholder="Masukkan Kode">
                     <label for="newPassword" class="mb-1">Kata Sandi Baru</label>
                    <input type="password" class="form-control mb-4" id="newPassword" name="newPassword" value="{{ old('newPassword') }}" required autofocus placeholder="Masukkan Password Baru">
                    <button type="submit" class="btn btn-primary mt-3 text-dark">{{ __('Masuk') }}</button>
                </form>
                <!-- Confirmation link -->
                <p>Tidak punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
            </div>
            <div class="col-8 d-flex justify-content-center align-items-center">
                <img src="../image/bro.svg" alt="login">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>