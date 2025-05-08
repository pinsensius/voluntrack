<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category Page</title>
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        @if (auth()->user() && auth()->user()->role == 'admin')
            <x-navbarAdmin />
        @else
            <x-navbar />
        @endif
        <main class="mb-5">
            <div class="row categories">
                <div class="col cText">
                    <h5>KATEGORI</h5>
                </div>
            </div>
            <div class="row category gap-5 row-cols-1">
                <div class="col">
                    <img src="../icon/alam.svg" alt="alam" width="50" height="50">
                    <h5>Bencana Alam</h5>
                    <p>Donasi atau jadi relawan untuk membantu korban bencana alam</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="../icon/laut.svg" alt="alam" width="50" height="50">
                    <h5>#SELAMATKANLAUT</h5>
                    <p>Donasi atau jadi relawan untuk menyelamatkan laut</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="../icon/bayi.svg" alt="alam" width="50" height="50">
                    <h5>Balita & Bayi Sakit</h5>
                    <p>Donasi untuk bantu menyembuhkan bayi yang sakit</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="../icon/panti.svg" alt="alam" width="50" height="50">
                    <h5>Panti Asuhan</h5>
                    <p class="m-0 pt-2">Donasi atau jadi relawan untuk membantu anak-anak panti asuhan</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="../icon/kemanusiaan.svg" alt="alam" width="50" height="50">
                    <h5>kemanusiaan</h5>
                    <p class="m-0 pt-2">Donasi atau jadi relawan untuk sesama manusia</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="../icon/hewan.svg" alt="alam" width="50" height="50">
                    <h5>#SELAMATKANHEWAN</h5>
                    <p class="m-0 pt-2">Donasi atau jadi relawan untuk membantu hewan </p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
            </div>
        </main>


        <x-footer />
    </div>

    <script src="category.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
