<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Page</title>
    <link rel="stylesheet" href="{{ asset('css/registRelawan.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .form-style input{
            width: 500px !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <x-navbar />
        

        <!-- Isi / Main -->
        <main id="page1">
            <div class="row judul">
                <div class="col judul" style="margin-bottom:-40px">
                    
                    
                    <div class="col">
                        <h1>FORMULIR DAFTAR RELAWAN</h1>
                    </div>
                    
                </div>
            </div>
        </main>

        <main id="page2" style="margin-bottom: 200px;">
            <div class="row">
                <div class="col-4">
                    <div class="input d-flex flex-column">
                        <form action="join-event.php" class="form-style" method="POST" validate>
                            <input type="hidden" name="user_id" value="">
                            <input type="hidden" name="event_id" value="">
                            <label for="nama">Nama Lengkap <span>*</span></label>
                            <br>
                            <input type="text" name="nama_lengkap"  placeholder="Nama lengkap anda">
                            <br>
                            <label for="telp" >Nomor Telepon <span>*</span></label>
                            <br>
                            <input type="tel" name="nomor_telepon"  placeholder="Nomor telepon anda">
                            <br>
                            <label for="organisai">Nama Organisasi</label>
                            <br>
                            <input type="text" name="nama_organisasi"  placeholder="Organisasi yang diikuti">
                            <br>
                            <label for="nik">NIK <span>*</span></label>
                            <br>
                            <input type="text" name="nik"  placeholder="Nomor Induk Kependudukan">
                            <br>
                            <input type="hidden" name="relawan" value="relawans">

                            <p class="opacity-75">Jika organisai hanya perwakilan saja</p>

                        </form>
                    </div>
                    <button class="py-3 confirm">Ikut!</button>
                </div>
                <div class="col text-center">
                    <img src="../image/joinevent.svg" alt="joinevent" class="mt-5">
                </div>
            </div>
        </main>

        <x-footer />
    </div>
    
    <script src="join-events.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>