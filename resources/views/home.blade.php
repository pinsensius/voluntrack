<span style="display: none;">p</span>
<!doctype html>
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

<body>
    <div class="container-fluid">
        {{-- secara default, yang muncul x-navbar, tapi jika ada yang login dan ber role admin, maka yang muncul x-navbarAdmin --}}
        @if (auth()->user() && auth()->user()->role == 'admin')
            <x-navbarAdmin />
        @else
            <x-navbar />
        @endif


        <!-- Awal Main -->
        <main id="page1">
            <!-- Page 1 -->
            <div class="row">
                <div class="col left-text">
                    <h1>Lakukan sesuatu untuk membantu sesama dan lingkungan!</h1>
                    <div class="caption">
                        <span style="opacity: .5;">Voluntrack adalah sebuah platform yang dibuat untuk membantu
                            sesama
                            dan lingkungan melalui
                            kegiatan donasi dan pencarian relawan</span>
                    </div>
                    <button type="button">Mari Bantu</button>
                    <div class="data-kegiatan d-flex justify-content-evenly">
                        <div class="data">
                            <h2>400</h2>
                            <p>Event terlaksana</p>
                        </div>
                        <div class="data">
                            <h2>30jt</h2>
                            <p>Donasi setiap hari</p>
                        </div>
                        <div class="data">
                            <h2>50rb</h2>
                            <p>Relawan aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col hero-image">
                    <img src="{{ asset('image/1.png') }}" alt="1">
                </div>
            </div>
        </main>


        <!-- Page 2 -->
        <main id="page2">
            <div class="row categories">
                <div class="col cText">
                    <h5>KATEGORI</h5>
                    <p style="font-family: 'jakartaSansBold'; font-size: 30px;">Kami memiliki beberapa kategori yang
                        bisa kamu pilih
                    </p>
                </div>
                <div class="col cText2 d-flex justify-content-end align-items-end">
                    <p><a href="{{ route('category') }}">Lihat Semua &#x2794;</a></p>
                </div>
            </div>
            <div class="row category">
                <div class="col ms-1">
                    <img src="{{ asset('icon/alam.svg') }}" alt="alam" width="50" height="50">
                    <h5>Bencana Alam</h5>
                    <p>Donasi atau jadi relawan untuk membantu korban bencana alam</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="{{ asset('icon/laut.svg') }}" alt="alam" width="50" height="50">
                    <h5>#SELAMATKANLAUT</h5>
                    <p>Donasi atau jadi relawan untuk menyelamatkan laut</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col">
                    <img src="{{ asset('icon/bayi.svg') }}" alt="alam" width="50" height="50">
                    <h5>Balita & Bayi Sakit</h5>
                    <p>Donasi untuk bantu menyembuhkan bayi yang sakit</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
                <div class="col me-1">
                    <img src="{{ asset('icon/panti.svg') }}" alt="alam" width="50" height="50">
                    <h5>Panti Asuhan</h5>
                    <p class="m-0 pt-2">Donasi atau jadi relawan untuk membantu anak-anak panti asuhan</p>
                    <a href="#" class="fw-medium">Lihat Lebih Lanjut</a>
                </div>
            </div>
        </main>

        <!-- Page 3 -->
        <main id="page3">
            <div class="row">
                <div class="col cText">
                    <h5>KEGIATAN</h5>
                    <p style="font-family: 'jakartaSansBold'; font-size: 30px;">Kegiatan yang sedang berlangsung
                        saat
                        ini</p>
                </div>
                <div class="col cText2 d-flex justify-content-end align-items-end">
                    <p><a href="{{ route('event.index') }}"
                            style="text-decoration:none;color: #51A433;font-size:16px;font-weight:bold;">Lihat Semua
                            &#x2794; </a></p>
                </div>
            </div>
            <div class="row gap-4" style="margin-top: 50px;">
                @forelse ($data as $event)

                    @if ($event->status === 'approved')
                        <div class="col card p-0">
                            @if (auth()->id() === $event->host)
                                <p class="text-green-500">Status : {{ $event->status }}</p>
                            @endif
                            <a href="{{ route('event.show', $event->id_event) }}">
                                <img src="{{ asset('storage/' . json_decode($event->event_image)[0]) }}"
                                    alt="{{ $event->nama }}" height="200px" width="100%" style="object-fit: cover;">
                            </a>
                            <div class="caption-kegiatan">
                                <div class="caption d-flex">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 mt-2">
                                        <a href="{{ route('event.show', $event->id_event) }}"
                                            class="text-gray-900 no-underline font-bold"
                                            style="text-decoration: none; color: black; font-weight: bold; margin: 20px 0;">{{ $event->nama }}</a>
                                    </h3>

                                </div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm" style="color: #4b5563;">Hosted
                                    by: <span class="font-medium text-blue-500">{{ $event->user->username }}</span>
                                </p>
                                <div class="d-flex justify-content-between mt-4">
                                    <span class="text-gray-600 dark:text-gray-400 text-sm"><span
                                            style="font-weight: bold;">Start:</span>
                                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</span>
                                    <span class="text-gray-600 dark:text-gray-400 text-sm"><span
                                            style="font-weight: bold;">End:</span>
                                        {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</span>
                                </div>

                                <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                                    {{ Str::limit(strip_tags($event->event_detail), 100) }}</p>
                                <div class="mt-2">
                                    <p>Progress :</p>
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $event->progress_event }};" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                        <p style="position: absolute; left: 10px; font-weight: bold;">
                                            {{ $event->progress_event }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <p class="text-green-500 empty-event">Waduh, saat ini tidak ada event yang sedang berjalan</p>


                @endforelse
            </div>
        </main>
    </div>

    <!-- Page 4 -->
    <!-- dihapus -->


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
