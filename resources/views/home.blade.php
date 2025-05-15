<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voluntrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Membatasi maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            /* Memastikan teks tambahan tidak terlihat */
            line-height: 1.5;
            /* Atur tinggi baris */
            min-height: calc(1.5em * 2);
            /* Pastikan ruang minimal untuk 2 baris */
        }
    </style>

</head>

<body class="">
    <div class="container-fluid">
        {{-- secara default, yang muncul x-navbar, tapi jika ada yang login dan ber role admin, maka yang muncul
        x-navbarAdmin --}}
        @if (auth()->user() && auth()->user()->role == 'admin')
        <x-navbarAdmin />
        @else
        <x-navbar />
        @endif


        <!-- Awal Main -->
        <div id="page1">
            <!-- Page 1 -->
            <div class="row flex-column-reverse flex-md-row align-items-center">
                <!-- Bagian Teks Kiri -->
                <div class="col left-text text-center text-md-start">
                    <h1 class="fs-2 fs-md-1 w-100" style="word-wrap: break-word;">
                        Lakukan sesuatu untuk membantu sesama dan lingkungan!
                    </h1>
                    <div class="caption w-100">
                        <span class="fs-6 fs-md-5 opacity-50 d-block" style="word-wrap: break-word;">
                            Voluntrack adalah sebuah platform yang dibuat untuk membantu sesama
                            dan lingkungan melalui kegiatan donasi dan pencarian relawan
                        </span>
                    </div>
                    <button type="button" class="mt-3">Mari Bantu</button>
                    <div class="data-kegiatan d-flex justify-content-evenly flex-wrap mt-4">
                        <div class="data text-center">
                            <h2>400</h2>
                            <p>Event terlaksana</p>
                        </div>
                        <div class="data text-center">
                            <h2>30jt</h2>
                            <p>Donasi setiap hari</p>
                        </div>
                        <div class="data text-center">
                            <h2>50rb</h2>
                            <p>Relawan aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Bagian Gambar Kanan -->
                <div class="col hero-image text-center mb-4 mb-md-0">
                    <img src="{{ asset('image/1.png') }}" alt="1" class="img-fluid">
                </div>
            </div>

        </div>

        <!-- Page 2 -->
        <div id="page2">
            <div class="row categories d-flex flex-column flex-md-row">
                <div class="col cText order-1 order-md-1">
                    <h5>KATEGORI</h5>
                    <p style="font-family: 'jakartaSansBold'; font-size: 30px;">
                        Kami memiliki beberapa kategori yang bisa kamu pilih
                    </p>
                </div>
                <div class="col cText2 d-flex justify-content-md-end align-items-md-end order-2 order-md-2">
                    <p class="mt-3 mt-md-0">
                        <a href="{{ route('category') }}">Lihat Semua &#x2794;</a>
                    </p>
                </div>
            </div>

            <div class="row category justify-content-center text-center w-full flex-nowrap">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                    <div class="d-flex flex-column align-items-center text-center w-100">
                        <img src="{{ asset('icon/alam.svg') }}" alt="alam" width="50" height="50">
                        <h5 class="mt-2">Bencana Alam</h5>
                        <p>Donasi atau jadi relawan untuk membantu korban bencana alam</p>
                        <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                    <div class="d-flex flex-column align-items-center text-center w-100">
                        <img src="{{ asset('icon/laut.svg') }}" alt="laut" width="50" height="50">
                        <h5 class="mt-2">#SELAMATKANLAUT</h5>
                        <p>Donasi atau jadi relawan untuk menyelamatkan laut</p>
                        <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                    <div class="d-flex flex-column align-items-center text-center w-100">
                        <img src="{{ asset('icon/bayi.svg') }}" alt="bayi" width="50" height="50">
                        <h5 class="mt-2">Balita & Bayi Sakit</h5>
                        <p>Donasi untuk bantu menyembuhkan bayi yang sakit</p>
                        <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                    <div class="d-flex flex-column align-items-center text-center w-100">
                        <img src="{{ asset('icon/panti.svg') }}" alt="panti" width="50" height="50">
                        <h5 class="mt-2">Panti Asuhan</h5>
                        <p>Donasi atau jadi relawan untuk membantu anak-anak panti asuhan</p>
                        <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                    </div>
                </div>
            </div>



        </div>

        <!-- Page 3 -->
        <div id="page3">
            <div class="row d-flex flex-column flex-md-row justify-content-between align-items-start mb-4">
                <div class="col-12 col-md-6 cText">
                    <h5>KEGIATAN</h5>
                    <p style="font-family: 'jakartaSansBold'; font-size: 30px;">Kegiatan yang sedang berlangsung saat
                        ini</p>
                </div>
                <div
                    class="col-12 col-md-6 cText2 d-flex justify-content-md-end justify-content-center align-items-center mt-3 mt-md-0">
                    <p>
                        <a href="{{ route('event.index') }}"
                            style="text-decoration:none; color: #51A433; font-size:16px; font-weight:bold;">
                            Lihat Semua &#x2794;
                        </a>
                    </p>
                </div>
            </div>

            <div class="row">
                @forelse ($data as $event)
                @if ($event->status === 'approved')
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <div class="card w-100 p-0 shadow-sm">
                        @if (auth()->id() === $event->host)
                        <p class="text-success m-2">Status: {{ $event->status }}</p>
                        @endif
                        <a href="{{ route('event.show', $event->id_event) }}" style="width: 100%; height: 200px;">
                            <img src="{{ asset('storage/' . json_decode($event->event_image)[0]) }}"
                                alt="{{ $event->nama }}" height="200" width="100%" style="object-fit: cover;">
                        </a>
                        <div class="p-3">
                            <h5 class="fw-bold mb-2">
                                <a href="{{ route('event.show', $event->id_event) }}"
                                    class="text-dark text-decoration-none">
                                    {{ $event->nama }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">Hosted by: <span class="fw-medium text-primary">{{
                                    $event->user->username }}</span></p>
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span><strong>Start:</strong>
                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</span>
                                <span><strong>End:</strong>
                                    {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</span>
                            </div>
                            <p class="text-muted small">
                                {{ Str::limit(strip_tags($event->event_detail), 100) }}
                            </p>
                            <div class="mt-3">
                                <p class="mb-1">Progress :</p>
                                <div class="progress position-relative" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $event->progress_event }}%;"
                                        aria-valuenow="{{ $event->progress_event }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                    <span class="position-absolute start-0 ps-2 text-white fw-bold"
                                        style="font-size: 12px;">
                                        {{ $event->progress_event }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @empty
                <div class="col-12">
                    <p class="text-success text-center mt-4">Waduh, saat ini tidak ada event yang sedang berjalan
                    </p>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- Page 5 -->
    <!-- isinya dibuat ke dalam komponen dikarenakan ketika sudah login. section yang ditampilkan akan berbeda -->
    <x-SecAboutUs />
    <!-- ketika sudah login, akan diganti dengan secKomunitas -->

    <x-footer />


    </div>
    <!-- Akhir Main -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>