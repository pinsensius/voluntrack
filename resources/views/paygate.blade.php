<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Page</title>
    <link rel="stylesheet" href="{{ asset('css/paygate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-_apIHAKTdVMvcov_"></script>
</head>

<body>
    <div class="container-fluid">
        <x-navbar />
        <!-- Isi / Main -->
        <main id="page1" class="my-5">
            <div class="row row1">
                <div class="col-6 left px-0">
                    <img src="../image/ed1-2.png" alt="ed1" width="500px">
                </div>
                <div class="col right d-flex align-items-center ps-0">
                    <h1>Bantu Korban Gempa di Sumedang!</h1>
                </div>
            </div>
            <div class="row row2 pt-5">
                <div class="col-5 left">
                    <h5>MASUKKAN NOMINAL DONASI</h5>
                    <div class="input d-flex flex-column">
                        <form action="paygate.php" class="paying" method="POST">
                            <label for="nominal">Masukan Nominal <span>*</span></label>
                            <input type="number" name="nominal" class="form-control border" placeholder="Masukan nominal" class="nominal">
                            <input type="hidden" name="event_id" value="">
                            <input type="hidden" name="user_id" value="">
                            <input type="hidden" name="donate" value="donasi">
                        </form>

                        <!-- <label for="poin">Masukan Poin <span>*</span></label>
                        <input type="number" placeholder="Masukan poin" class="poin"> -->

                    </div>
                    <div class="confirm d-flex align-items-center mt-2 ">
                        <input type="checkbox" class="ms-2">
                        <p class="m-0 ms-3">Saya memahami dan menuruti Syarat dan Ketentuan yang berlaku</p>
                    </div>
                </div>
            </div>
        </main>

        <main>
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>
        </main>

        <main id="page2" class="mb-5">
            <div class="row row1 gap-5 ">
                <div class="col-2 border left p-3 h-75 shadow">
                    <div class="name d-flex justify-content-center align-items-center">
                        <img src="../image/" style="height: 30px; border-radius: 100%" alt="user" width="30px">
                        <p></p>
                    </div>
                    <div class="points d-flex justify-content-between align-items-center mt-4">
                        <div class="poin d-flex align-items-center">
                            <img src="../image/poin.svg" alt="poin" width="24px">
                            <p class=" fw-bold">Poin</p>
                        </div>
                        <p class="m-0">status data</p>
                    </div>
                    <div class="level d-flex align-items-center mt-2">
                        <p>LV</p>
                        <p>$statusData['level']</p>
                    </div>
                    <div class="range d-flex justify-content-between mt-2">

                        <div class="progress" style="width:100%;margin: 0px 0 -10px 0;text-align:center">
                            <div class="progress-bar" role="progressbar" aria-valuenow="$expData" aria-valuemin="0" aria-valuemax="100">$expData XP</div>
                        </div>

                    </div>
                    <div class="donasi d-flex justify-content-between mt-4">
                        <p>Total Donasi</p>
                        <p>$totalDonasiCount</p>
                    </div>
                    <div class="relawan d-flex justify-content-between">
                        <p>Total Menjadi Relawan</p>
                        <p>$totalRelawanCount</p>
                    </div>
                    <div class="acara d-flex justify-content-between">
                        <p>Total Membuat Acara</p>
                        <p>$totalHostingCount</p>
                    </div>
                </div>
                <div class="col-9 right ms-2">
                    <h5>PILIH METODE PEMBAYARAN</h5>
                    <div class="metode  d-flex justify-content-between my-5">
                        <div class="box pay1 payed">
                            <img src="../image/qris.svg" alt="qris">
                        </div>
                        <div class="box pay2 payed">
                            <img src="../image/ewallet.svg" alt="ewallet">
                        </div>
                        <div class="box pay3 payed">
                            <img src="../image/bank.svg" alt="bank">
                        </div>
                    </div>

                    <!-- list metode pembayaran qris -->
                    <div class="qris mb-5 d-none">
                        <div class="box">
                            <img src="../image/qrisflip.svg" alt="qrisflip">
                        </div>
                    </div>

                    <!-- list metode pembayaran e wallet -->
                    <div class="ewallet mb-5 d-flex justify-content-between flex-wrap d-none">
                        <div class="box">
                            <img src="../image/gopay.svg" alt="gopay">
                        </div>
                        <div class="box">
                            <img src="../image/dana.svg" alt="dana">
                        </div>
                        <div class="box">
                            <img src="../image/ovo.svg" alt="ovo">
                        </div>
                        <div class="box mt-3">
                            <img src="../image/spay.svg" alt="spay.svg">
                        </div>
                    </div>

                    <!-- List metode pembayaran bank -->
                    <div class="bank mb-5 d-flex justify-content-between flex-wrap d-none">
                        <div class="box">
                            <img src="../image/bni.svg" alt="bni">
                        </div>
                        <div class="box">
                            <img src="../image/bri.svg" alt="bri">
                        </div>
                        <div class="box">
                            <img src="../image/mandiri.svg" alt="mandiri">
                        </div>
                        <div class="box mt-3">
                            <img src="../image/bca.svg" alt="bca.svg">
                        </div>
                        <div class="box mt-3">
                            <img src="../image/permata.svg" alt="permata.svg">
                        </div>
                        <div class="box mt-3">

                        </div>
                    </div>

                    <h5>RINGKASAN PEMBAYARAN</h5>
                    <div class="ringkasan border p-4 ">
                        <div class="ringkas nominal">
                            <p>Nominal</p>
                            <p class="nominalTotal"></p>
                        </div>
                        <div class="ringkas poin mt-5 mb-5">
                            <p>Total poin</p>
                            <p class="poinTotal"></p>
                        </div>
                        <hr>
                        <div class="ringkas total mt-5">
                            <p>Total</p>
                            <p class="totalDonasi"></p>
                        </div>
                    </div> 
                    
                    <button><a href="https://app.sandbox.midtrans.com/payment-links/1714378174212"
                            style="text-decoration: none; color: black; font-family: 'jakartaSansBold';" target="_blank">Donasi Sekarang</a>
                    </button>

                </div>
            </div>
        </main>


    </div>


    <script src="{{ asset('js/paygate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>