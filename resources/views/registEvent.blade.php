<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regist Event</title>
    <link rel="stylesheet" href="{{asset('css/registEvent.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        .form-select {
            margin-top: 60px;
            padding: 16px;
            font-size: .9em;
            width: 70%;
            margin-bottom: 30px;
            margin-left: 5px;
        }

        .form-select {
            padding: 16px;
            font-size: .9em;
            border: 1px solid gray;
            border-radius: 2px;
            color: gray;
        }

        .select-group {
            margin-top: -40px;
        }

        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            min-height: 200px;
        }

        .eventForm input {
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <x-navbar />



        <!-- Isi / Main -->
        <main id="page1">
            <div class="col judul" style="margin-bottom:-40px">
                <div class="col">
                    <h1>FORMULIR DAFTAR EVENT</h1>
                </div>

            </div>
        </main>

        <main id="page2">
            <div class="row">
                <div class="col-7 left">
                    <div class="input flex-column">
                        <form action="{{ route('event.store') }}" class="eventForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="host" value="{{ auth()->id() }}">
                            <label for="nama">Nama Kegiatan <span>*</span></label>
                            <br>
                            <input value="{{ old('nama') }}" type="text" name="nama" placeholder="Masukan nama kegiatan">
                            @error('nama')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="kategori">Kategori Kegiatan <span>*</span></label>
                            <br>
                            <select class="form-select" name="tags" id="kategori" style="width:100%;margin-left:-2px;" aria-label="Default select example">
                                <option selected>Plih Kategori Kegiatan</option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Kemanusiaan">Kemanusiaan</option>
                                <option value="Lingkungan">Lingkungan</option>
                            </select>


                            <label for="waktu">Waktu Kegiatan <span>*</span></label>
                            <br>
                            <div class="tanggal d-flex">
                                <div class="mulai d-flex align-items-center text-center">
                                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-200">Tanggal Mulai</label>
                                    <br>
                                    <input type="date" name="tanggal_mulai" class="">
                                    @error('tanggal_mulai')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="selesai d-flex align-items-center ms-3 text-center">
                                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-200">Tanggal Selesai</label>

                                    <br>
                                    <input type="date" name="tanggal_selesai" class="">
                                    @error('tanggal_selesai')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="lokasi_map" class="block text-sm font-medium text-gray-200">Pilih Lokasi Event</label>
                                <div id="lokasi_map" class="w-full h-64 rounded-md shadow-md"></div>
                                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                                <label for="alamat" class="block text-sm font-medium text-gray-200 mt-4">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md" readonly>
                                <p class="text-sm text-gray-400 mt-2">Klik di peta untuk memilih lokasi.</p>
                            </div>
                            <label for="deskripsi">Deskripsi Kegiatan <span>*</span></label>
                            <textarea name="event_detail" id="editor" placeholder="Masukkan kebutuhan kegiatan"></textarea>
                            <label for="kebutuhan">Kebutuhan Kegiatan <span>*</span></label>
                            <textarea name="requirement" id="editor2" cols="30" rows="10" placeholder="Masukkan kebutuhan kegiatan"></textarea>
                            <label for="target">Target Donasi Kegiatan <span>*</span></label>
                            <br>
                            <input type="number" name="target_donasi" placeholder="Masukkan target donasi">
                            <br>
                            <label for="target">Gambar-Gambar Kegiatan <span>*</span></label>
                            <input type="file" style="margin-left: -15px;" name="files[]" multiple="4">
                            <input type="hidden" name="forgot" value="Daftar Sekarang">
                        </form>
                    </div>
                </div>
                <div class="col-5 right">
                    <!-- <div class="input d-flex flex-column" style="margin-left: 100px;">
                        <label for="nama">Nama Lengkap <span>*</span></label>
                        <input type="text" placeholder="Nama lengkap anda">
                        <label for="telp">Nomor Telepon <span>*</span></label>
                        <input type="tel" placeholder="Nomor telepon anda">
                        <label for="organisai">Nama Organisasi</label>
                        <input type="text" placeholder="Organisasi yang diikuti">
                        <label for="nik">NIK <span>*</span></label>
                        <input type="text" placeholder="Nomor Induk Kependudukan">
                        <p class="opacity-75">Jika organisai hanya perwakilan saja</p>

                        <label for="ktp">KTP <span>*</span></label>
                        <div class="ktp text-center mt-3">
                            <img src="../icon/unggah.svg" alt="unggah">
                            <p><a href="">Tekan disini untuk mengunggah</a> Estensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                        </div>
                        <p class="opacity-75 mt-3">Jika organisai hanya perwakilan saja</p>
                    </div>
                     -->
                </div>
            </div>
            <div class="row row2">
                <div class="col">
                    <button class="confirmationButton" style="margin-top: -20px">Daftar Sekarang</button>
                </div>
            </div>
        </main>


        <footer>
            <div class="container">
                <div class="row pt-5">
                    <div class="col-6">
                        <div class="f-logo d-flex align-items-center ms-2 mb-3">
                            <img src="../icon/1.svg" alt="logo">
                            <h5 class="mb-0 ms-2 fw-bold">Voluntrack.</h5>
                        </div>
                        <p class="opacity-75 w-75 fs-6 ">Voluntrack: Platform donasi dan kegiatan relawan untuk
                            lingkungan
                            dan
                            masyarakat. Memberikan edukasi dan kesempatan bagi pengguna untuk berkontribusi melalui
                            donasi atau partisipasi langsung dalam kegiatan..</p>
                    </div>
                    <div class="col-3 d-flex justify-content-end
                ">
                        <div class="menu">
                            <h5 class="fw-bold">Menu</h5>
                            <ul class="list-unstyled opacity-75">
                                <li>Beranda</li>
                                <li>Kategori</li>
                                <li>Kegiatan</li>
                                <li>Edukasi</li>
                                <li>Tentang Kami</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3 d-flex justify-content-end
                ">
                        <div class="menu">
                            <h5 class="fw-bold">Legal</h5>
                            <ul class="list-unstyled opacity-75">
                                <li>Privacy</li>
                                <li>Ketentuan</li>
                                <li>Kontak</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 pb-5 d-flex align-items-center">
                    <div class="col-6">
                        <p class="m-0 fw-bold">&copy;2024 VolunTrack. All right reserved.</p>
                    </div>
                    <div class="col-6 d-flex justify-content-center gap-5">
                        <img src="../icon/instagram.svg" alt="ig">
                        <img src="../icon/github.svg" alt="github">
                        <img src="../icon/x.svg" alt="x">
                        <img src="../icon/linkedin.svg" alt="linkedin">
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="regist-events.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const map = L.map('lokasi_map').setView([0, 0], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            let marker;

            function updateMarker(lat, lng) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Ambil alamat menggunakan reverse geocoding
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        const alamat = data.display_name || "Alamat tidak ditemukan";
                        document.getElementById('alamat').value = alamat;
                    })
                    .catch(error => {
                        console.error('Error fetching alamat:', error);
                        document.getElementById('alamat').value = "Gagal mendapatkan alamat";
                    });

                marker.on('dragend', function(e) {
                    const position = marker.getLatLng();
                    document.getElementById('latitude').value = position.lat;
                    document.getElementById('longitude').value = position.lng;
                    updateMarker(position.lat, position.lng);
                });
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        map.setView([lat, lng], 13);
                        updateMarker(lat, lng);
                    },
                    function() {
                        alert("Tidak dapat mengambil lokasi Anda. Peta dimulai di lokasi default.");
                        map.setView([0, 0], 2);
                    }
                );
            } else {
                alert("Browser Anda tidak mendukung Geolocation.");
                map.setView([0, 0], 2);
            }

            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                updateMarker(lat, lng);
            });
        });
    </script>

</body>

</html>