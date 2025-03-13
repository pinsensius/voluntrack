<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
                    <p>Silahkan Masukkan Akun Anda</p>
                </div>
                <!-- Form login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email input -->
                    <label for="emailField" class="mb-1">Email <span>*</span></label>
                    <input type="email" class="form-control mb-4" id="emailField" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
                    <!-- Password input -->
                    <label for="passwordField" class="mb-1">Kata Sandi <span>*</span></label>
                    <input type="password" class="form-control mb-1" id="passwordField" name="password" required placeholder="Masukkan kata sandi">
                    <!-- Remember me dan forgot password -->
                    <div class="remember pt-3 pb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
                            <label for="remember_me" class="ms-1">Ingat Saya</label>
                        </div>
                        <a href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary mt-3 text-dark">{{ __('Masuk') }}</button>
                </form>

                <!-- Register link -->
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