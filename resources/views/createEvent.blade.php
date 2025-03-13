<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regist Event</title>
    <link rel="stylesheet" href="{{ asset('css/createEvent.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
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
                        <form action="regist-event.php" class="eventForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="host_id" value="">
                            <label for="kegitan">Nama Kegiatan <span>*</span></label>
                            <br>
                            <input type="text" name="nama" placeholder="Masukan nama kegiatan">
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
                                    <p>Tanggal mulai : </p>
                                    <br>
                                    <input type="date"  name="tanggal_mulai" class="">
                                </div>
                                <div class="selesai d-flex align-items-center ms-3 text-center">
                                    <p>Tanggal Selesai :</p>
                                    <br>
                                    <input type="date" name="tanggal_selesai" class="">
                                </div>
                            </div>
                            <label for="lokasi">Lokasi Kegiatan <span>*</span></label>
                            <br>
                            <input type="text" name="lokasi" placeholder="Masukkan lokasi kegiatan">
                            <br>
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
                    <div class="input d-flex flex-column" style="margin-left: 100px;">
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
                    
                </div>
            </div>
            <div class="row row2">
                <div class="col">
                    <button class="confirmationButton" style="margin-top: -20px">Daftar Sekarang</button>
                </div>
            </div>
        </main>


        <x-footer />
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
</body>

</html>