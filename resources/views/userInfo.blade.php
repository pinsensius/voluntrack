<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information</title>
    <link rel="stylesheet" href="{{ asset('css/userInfo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-control {
            height: 43.2px;
            margin-bottom: 10px;
        }

        .form-title {
            font-size: 12px;
            font-weight: bold;
            color: #999999;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <x-navbar />

        <!-- Utama -->
        <main class="mt-5">
            <div class="row">
                <img src="../image/backdrop.png" alt="backdrop">
            </div>
            <div class="row profile">
                <div class="col-2">
                    <img src="../image/default.jpg" class="img-fluid border" alt="user" style="width:179px;height:179px;border-radius: 100%">;
                </div>
                <div class="col mt-4">
                    <div class="names ps-5 ms-4 d-flex justify-content-between pe-4 ">
                        @auth
                        <div class="name">
                            <h4 class="m-0">{{ Auth::user()->username }}</h4>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        @endauth
                        <div class="edit d-flex gap-4">
                            <button class="batalEdit">Batalkan</button>
                            <button class="editProfile">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-5 row1">
                <div class="col-4 left">
                    <h5>Profil Publik</h5>
                    <p class="mt-3" style="color: #999999;">Perubahan ini akan terlihat di profil anda.</p>
                </div>
                <div class="col-5 right">

                    <form action="{{ route('profile.update') }}" class="editForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <span class="form-title">Username</span>
                        <input type="text" class="form-control" style="font-weight: bolder;" name="username" value="">
                        <span class="form-title">E-Mail</span>
                        <input type="text" class="form-control" style="font-weight: bolder;" name="email" value="">
                        <span class="form-title">No Alamat</span>
                        <input type="text" class="form-control" style="font-weight: bolder;" name="alamat" value="">
                        <span class="form-title">No Telepon</span>
                        <input type="text" class="form-control" style="font-weight: bolder;" name="noHP" value="">
                        <span class="form-title">Foto profil</span>
                        <input type="file" class="form-control imgProfileInput" style="font-weight: bolder;" id="profilImg" name="profilImg">
                        <span class="form-title">Role user</span>
                        <select name="roleUser" class="form-control" id="roleUser">
                            <option value="Relawan">Relawan</option>
                            <option value="Donatur">Donatur</option>
                        </select>
                        <span class="form-title">NIK</span>
                        <input type="text" class="form-control" style="font-weight: bolder;" id="nik" name="nik" value="">
                        <span class="form-title">KTP</span>
                        <input type="file" class="form-control" style="font-weight: bolder;" id="ktp" name="ktp">
                        <input type="hidden" name="confirmation" value="confirm">
                    </form>
                </div>
            </div>
            <hr>
            <div class="row row2">
                <div class="col-4 left">
                    <h5>Profil Publik</h5>
                    <p class="mt-3" style="color: #999999;">Perubahan ini akan terlihat di profil anda.</p>
                </div>
                <div class="col-5 right d-flex">
                    <img src="../image/default.jpg" class="img-fluid border" alt="user" style="width:120px;height:120px;border-radius: 100%">

                    <div class="upload text-center border p-3 ms-4">
                        <img src="../icon/upload.svg" class="editImgProfil" alt="upload">
                        <p><u style="font-family: 'jakartaSansMedium';">Tekan disini untuk mengunggah.</u>Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <script src="userInfos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>