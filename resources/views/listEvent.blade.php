<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Page</title>
    <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .group-button button {
            width: 100%;
            padding: 15px;
            margin: 25px 0;
            font-family: 'jakartaSansBold';
            border: none;
            border-radius: 10px;
            background-color: #AEF161;
        }

        .group-button .button2 {
            background: transparent;
            color: #7E9C5C;
            border: 1px solid #7E9C5C;
        }

        p.eventDetails {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 110px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <x-navbar />

        <main>
            <div class="row row1">
                <div class="col judul">
                    <h5>KEGIATAN</h5>
                </div>
            </div>
            <div class="row row2">
                <div class="col search">
                    <div class="input-group">
                        <form action="event.php" method="post">
                            <div class="d-flex">
                                <div class="search d-flex align-items-center border" style="width: 500px;">
                                    <span class="p-2"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control border-0" name="search" id="search" placeholder="Tuliskan disini" aria-label="Search" aria-describedby="searchIcon">
                                </div>
                                <select name="category" id="category" style="width: 100px; border:none; font-size: .8em;" class="border p-2">
                                    <option value="null">Category</option>
                                    <option value="Kemanusiaan">Kemanusiaan</option>
                                    <option value="Lingkungan">Lingkungan</option>
                                    <option value="Keuangan">Keuangan</option>
                                </select>
                                <select name="order" id="order" style="width: 100px; border:none; font-size: .8em;" class="border p-2">
                                    <option value="null">Order by</option>
                                    <option value="Terbaru">Terbaru</option>
                                    <option value="Terlama">Terlama</option>
                                </select>
                                <button type="submit" name="filter" value="Submit" class="ms-3" style="width:100px; border:none; border-radius:10px; background-color:#AEF161; font-family: 'jakartaSansBold'">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col create d-flex justify-content-end align-items-end">
                    <p>Ingin Membuat Kegiatan? <u><a href="{{ route('registEvent') }}" style="color:#258D00; font-weight:bold">Buat disini</a></u></p>
                </div>
            </div>
            <div class="row gap-4" style="margin-top: 50px;">
                <div class="row row-cols-3 gap-4 justify-content-center " style="margin-top: 50px;">

                    <div class="col capt card mx-5 p-0" style="width: 467px !important;">
                        <a href="{{ route('eventDetail') }}">
                            <div class="kartuEvent card">
                                <img src="../image/$image" height="308px" alt="gempa">
                                <div class="caption-kegiatan">
                                    <div class="caption d-flex">
                                        <h5 style="font-family: 'jakartaSansBold'">$nama</h5>
                                        <div class="kategori kategori1 d-flex justify-content-center align-items-center">
                                            <span>$tags</span>
                                        </div>
                                    </div>
                                    <p class="pt-3 eventDetails">$string</p>

                                    <div class="progres pt-4">
                                        <p class="mb-0">Progress donasi($progress_event %)</p>
                                        <div class="progress" style="margin-top:10px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="group-button p-3">
                                    <button class="donateButton">Donasi Sekarang</button>
                                    <button class="mt-0 mb-0 button2">Daftar Relawan</button>
                                </div>

                                <form action="../Event Detail/eventDetail.php" method="post" class="eventDetails">
                                    <input type="hidden" name="event_id" value="$eventId">
                                </form>

                                <form action="../Form Regist Join Event/join-event.php" method="post" class="daftarRelawan">
                                    <input type="hidden" name="event_id" value="$eventId">
                                </form>

                                <form action="../Payment-Gateway/paygate.php" method="post" class="donasi">
                                    <input type="hidden" name="event_id" value="$eventId">
                                </form>

                            </div>
                        </a>
                    </div>


                    <div class="col capt card p-0" style="width: 407px !important;">
                        <div class="kartuEvent card">
                            <img src="../image/$image" height="208px" alt="gempa">
                            <div class="caption-kegiatan">
                                <div class="caption d-flex">
                                    <h5 style="font-family: 'jakartaSansBold'">$nama</h5>
                                    <div class="kategori kategori1 d-flex justify-content-center align-items-center">
                                        <span>$tags</span>
                                    </div>
                                </div>
                                <div class="eventDetails">
                                    <p class="pt-3 eventDetails">$string</p>
                                </div>
                                <div class="progres pt-4" style="margin-bottom: -30px">
                                    <p class="mb-0">Progress donasi($progress_event %)</p>
                                    <div class="progress" style="margin-top:10px">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="$progress_event" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="group-button p-3">
                                <button class="donateButton">Donasi Sekarang</button>
                                <button class="mt-0 mb-0 button2">Daftar Relawan</button>
                            </div>

                            <form action="../Event Detail/eventDetail.php" method="post" class="eventDetails">
                                <input type="hidden" name="event_id" value="$eventId">
                            </form>

                            <form action="../Form Regist Join Event/join-event.php" method="post" class="daftarRelawan">
                                <input type="hidden" name="event_id" value="$eventId">
                            </form>

                            <form action="../Payment-Gateway/paygate.php" method="post" class="donasi">
                                <input type="hidden" name="event_id" value="$eventId">
                            </form>

                        </div>
                    </div>


                </div>
            </div>



            <div class="row mt-5 tombol">
                <div class="col p-0">
                    <button class="cText2">← Sebelumnya</button>
                </div>
                <div class="col p-0 d-flex justify-content-end">
                    <button class="cText2">Selanjutnya →</button>
                </div>
            </div>
        </main>



        <x-footer />
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="event.js"></script>
</body>

</html>