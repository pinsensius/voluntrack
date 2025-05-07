<x-app-layout>


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tentang Kami</title>
        <link rel="stylesheet" href="{{ asset('css/aboutUs.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <div class="container-fluid">

        {{-- <x-navbar /> --}}
        <main id="page1">
            <div class="row">
                <div class="col hero-image2">
                    <img src="../image/2.png" alt="">
                </div>
                <div class="col right-text">
                    <h5>TENTANG KAMI</h5>
                    <div class="flex">
                        <h1 class="mt-5">Mari Membantu Orang-orang di Seluruh Indonesia</h1>
                    </div>
                    <div class="caption">
                        <p class="fs-6 w-75  opacity-75">Voluntrack adalah sebuah platform yang dibuat untuk membantu
                            antar
                            sesama dan lingkungan melalui kegiatan donasi dan pencarian relawan.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Slogan -->
        <main id="page2">
            <div class="row">
                <div class="col left-text">
                    <h1>From Zero to Hero</h1>
                    <br>
                    <p class="fs-6 w-75  opacity-75">Jadilah pahlawan bagi orang-orang yang membutuhkan, jadilah
                        pahlawan untuk kehidupan sekitar, jadilah pahlawan di bumi kita ini!</p>
                    <br>
                    <p class="fs-6  opacity-75">Jadilah pahlawan dengan cara :</p>
                    <div class="mb-2">
                        <img src="../icon/zero1.svg" alt="zero1"><span class="fw-bold ms-2">Donasi</span>
                    </div>
                    <div class="">
                        <img src="../icon/zero2.svg" alt="zero2"><span class="fw-bold ms-2">Menjadi Relawan</span>
                    </div>
                    <button>Jadilah Pahlawan!</button>
                </div>
                <div class="col text-end">
                    <img src="../image/zero-image.png" alt="zero-image">
                </div>
            </div>
        </main>

        <!-- Founder page -->
        <main id="page3">
            <div class="d-flex flex-column flex-md-row flex-wrap justify-content-center">
                <div
                    class="col d-flex flex-column align-items-center justify-content-center text-center founder-profile">
                    <img src="../image/andre.png" alt="andre" class="mb-3">
                    <h4 class="mt-3">UI/UX</h4>
                    <h5 class="mt-3">Andre Pratama Milano</h5>
                </div>

                <div
                    class="col d-flex flex-column align-items-center justify-content-center text-center founder-profile">
                    <img src="../image/boy.png" alt="boy" class="mb-3">
                    <h4 class="mt-3">Back End / Lead</h4>
                    <h5 class="mt-3">Vinsesius Boido S</h5>
                </div>
                <div
                    class="col d-flex flex-column align-items-center justify-content-center text-center founder-profile">
                    <img src="../image/afri.png" alt="afri" class="mb-3">
                    <h4 class="mt-3">Front End</h4>
                    <h5 class="mt-3">Muhammad Afrizal</h5>
                </div>
            </div>
        </main>
        <main id="page4">
            <div class="row">
                <div class="col"">
                    <h1>Ulasan Dari Beberapa Klien Kami</h1>
                    <div class=" testimoni d-flex gap-5">
                        <img src="../image/klien1.png" alt="klien">
                        <div class="tes-text d-flex flex-column justify-content-between">
                            <img src="../image/kutip.svg" alt="kutip" width="60px">
                            <q>“Kami sangat terbantu dengan adanya web ini! Terimakasih Voluntrack”</q>
                            <div class="d-flex">
                                <div class="w-100 border-end">
                                    <h3>90%</h3>
                                    <span>kepuasan</span>
                                </div>
                                <div class="w-100 ms-5 text-center">
                                    <h3>140</h3>
                                    <span>Kegiatan Diikuti</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</x-app-layout>
