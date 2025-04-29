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
                <img src="../image/register.svg" alt="register">
            </div>
            <div class="col-4 input-form px-5">
                <div class="welcome mt-5 d-flex justify-content-center align-items-center me-5">
                    <img src="../icon/1.svg" alt="logo" width="50px">
                    <h5>Selamat Datang!</h5>
                </div>
                <p class="text-center" style="font-size: .8em;">Silahkan Isi Data Anda</p>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Nama Pengguna') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="username" value="{{ old('username') }}"
                            maxlength="80" placeholder="Masukkan nama pengguna" required autofocus>
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            maxlength="255" placeholder="Masukkan email" required>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Kata Sandi') }} <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan kata sandi" required>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Kata Sandi') }}
                            <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Konfirmasi kata sandi" required>
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 w-100 text-black">{{ __('Daftar') }}</button>
                </form>

                <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>