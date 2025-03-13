<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Detail
    </title>
    <link rel="stylesheet" href="{{ asset('css/eventDetail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid">
        <x-navbar />


        <main id="page1">
            <div class="row">
                <div class="col-8 left">
                    <img src='../image/$image' alt='ed1' width='100%'>

                    <div class="more-img mt-3 d-flex justify-content-between">
                        <img src="../image/$image" alt="ed2">
                        <img src='../image/$image' alt='ed3'>
                        <img src='../image/$image' alt='ed4'>
                    </div>
                </div>
                <div class="col right">
                    <h4>$nama</h4>
                    <p class="mt-4" style="font-size: 1.1em;">Detail Kegiatan</p>
                    <p>Waktu :</p>
                    <p>$jadwal_mulai - $jadwal_selesai</p>
                    <p>Alamat :</p>
                    <p>$lokasi</p>
                    <p class="mt-4" style="font-size: 1.1em;">Kategori Kegiatan :</p>
                    <div class="kategori kategori4 d-flex justify-content-center align-items-center">
                        <span>$tags</span>
                    </div>
                    <div class="progres pt-4">
                        <p class="mb-0">Progress donasi($progress_event %)</p>
                        <div class="progress" style="margin-top:10px">
                            <div class="progress-bar" role="progressbar" aria-valuenow="$progress_event" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <button class="donateButton"><a href="{{route('paygate') }}">Donasi Sekarang</a></button>
                    <button class="mt-0 mb-0 button2 joinRelawan"><a href="{{ route('registRelawan') }}">Daftar Relawan</a></button>

                    <form action="../Form Regist Join Event/join-event.php" method="post" class="daftarRelawan">
                        <input type="hidden" name="event_id" value="$eventId">
                    </form>

                    <form action="../Payment-Gateway/paygate.php" method="post" class="donasi">
                        <input type="hidden" name="event_id" value="$eventId">
                    </form>

                    <form action="../Donatur/donatur.php" method="post" class="donaturDetail">
                        <input type="hidden" name="event_id" value="$eventId">
                    </form>
                </div>
            </div>
        </main>

        <main id="page2">
            <div class="row">
                <div class="col-8">
                    <p class="deskripsi">Deskripsi Kegiatan</p>
                    $event_detail

                    <p class="kebutuhan mt-5">Kebutuhan Kegiatan</p>
                    $event_requirement

                    <p class="para-relawan mt-5">Para Relawan</p>
                    <img src="../image/para-relawan.png" alt="para relawan" class="mb-5">
                </div>
            </div>
        </main>



        <!-- </div>
                </div>
                <div class="col right">
                    <h4>Bantu Korban Gempa di Sumedang!</h4>
                    <p class="mt-4" style="font-size: 1.1em;">Detail Kegiatan</p>
                    <p>Waktu :</p>
                    <p>30 Maret 2023 - 25 Juni 2023</p>
                    <p>Alamat :</p>
                    <p>Sumedang Utara, Kabupaten Sumedang, Jawa Barat</p>
                    <p class="mt-4" style="font-size: 1.1em;">Kategori Kegiatan :</p>
                    <div class="kategori kategori4 d-flex justify-content-center align-items-center">
                        <span>Bencana Alam</span>
                    </div>
                    <div class="progres pt-4">
                        <p class="mb-0">Progress donasi gempa</p>
                        <img src="../image/progres1.svg" alt="1" width="100%">
                    </div>
                    <button>Donasi Sekarang</button>
                    <button class="mt-0 mb-0 button2 ">Daftar Relawan</button>
                </div>
            </div>
        </main> -->

        <main id="page2">
            <div class="row">
                <div class="col-8">
                    <p class="deskripsi">Deskripsi Kegiatan</p>
                    <p>Dalam rangka memberikan bantuan dan dukungan kepada para korban gempa di Sumedang, kami mengundang Anda untuk bergabung dalam acara "Bantu Korban Gempa di Sumedang!" Acara ini bertujuan untuk menyatukan komunitas dalam upaya memberikan bantuan serta menunjukkan solidaritas kepada mereka yang terkena dampak gempa bumi.</p>
                    <p>Acara ini tidak hanya memberikan bantuan praktis kepada para korban gempa, tetapi juga merupakan wujud nyata dari kepedulian dan solidaritas kita sebagai sesama manusia. Mari bersama-sama memberikan dukungan dan harapan kepada mereka yang membutuhkan dalam situasi sulit ini.</p>
                    <p>Tunggu apa lagi? Bergabunglah dengan kami dalam event "Bantu Korban Gempa di Sumedang!" dan mari bersama-sama mewujudkan perubahan yang positif bagi masyarakat yang terkena dampak gempa bumi.</p>

                    <p class="kebutuhan mt-5">Kebutuhan Kegiatan</p>
                    <p>Perlengkapan P3K :</p>
                    <ul>
                        <li>Kotak P3K dan perlengkapan medis dasar seperti perban, antiseptik, dan plester.</li>
                    </ul>
                    <p>Konsumsi :</p>
                    <ul>
                        <li>Makanan ringan, air minum, dan makanan untuk makan siang bagi peserta dan relawan.</li>
                        <li>Perlengkapan untuk menyajikan makanan dan minuman seperti meja, kursi, dan peralatan makan.</li>
                    </ul>
                    <p>Bantuan dan Donasi</p>
                    <ul>
                        <li>Tempat pengumpulan sumbangan seperti kotak donasi dan petugas untuk mengkoordinasikan pengumpulan bantuan.</li>
                        <li>Sarana untuk menyimpan dan mengatur barang-barang bantuan seperti pakaian, makanan, dan perlengkapan lainnya.</li>
                    </ul>
                    <p class="para-relawan mt-5">Para Relawan</p>
                    <img src="../image/para-relawan.png" alt="para relawan" class="mb-5">
                </div>
            </div>
        </main>


        <x-footer />
    </div>

    <script src="eventDetail.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>