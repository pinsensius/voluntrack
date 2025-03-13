<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="{{ asset('css/forgetpw.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-4 input-form p-5">
                <div class="logo d-flex pt-2 pb-2 align-items-center justify-content-center">
                    <img src="../icon/1.svg" alt="icon">
                    <h5>Voluntrack.</h5>
                </div>
                <div class="welcome mt-5 text-center">
                    <h5>Lupa Kata Sandi ?</h5>
                    <p>Untuk mengatur ulang kata sandi, Silahkan masukkan email anda</p>
                </div>
                <div class="input d-flex flex-column">
                    <form method="post" action="../../password-reset.php">
                        <label for="email">Email <span>*</span></label>
                        <input type="email" name="email" id="email" placeholder="Masukkan email">
                        <button type="submit" name="forgot" value="REQUEST TOKEN">Verifikasi Email</button>
                    </form>
                </div>
                <p class="forget-name">Lupa Nama Pengguna? <a href="" style="color: #258D00;">Pulihkan Disini</a></p>
            </div>
            <div class="garis"></div>
            <div class="col-8 d-flex justify-content-center align-items-center">
                <img src="../image/forgetpw.svg" alt="login" class="ms-5">
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>