<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        .aturEvent h5,
        .aturEvent a {
            margin: 0;
        }

        .aturEvent a {
            font-family: 'jakartaSansBold';
            padding: 10px 20px;
            background-color: #AEF161;
            color: black;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            color: black;
            text-align: center;
            cursor: pointer;
        }



        .validates>* {
            width: 33%;
        }

        .status .round {
            justify-content: center;
        }

        .jam {
            justify-content: end;
        }
    </style>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 ">
                <div class="row">
                    <div class="col">
                        <h1 class="fw-bolder">Halo, Admin</h1>
                        <p style="color: #999;">Berikut merupakan data voluntrack hari ini</p>
                    </div>
                </div>
                <div class="row d-flex border-top border-bottom py-5 gap-3" style="margin: 85px 0;">
                    <div class="col d-flex align-items-center gap-3">
                        <img src="{{ asset('icon/selesai.svg') }}" alt="icon">
                        <div class="">
                            <p style="margin: 0;" class="fw-bold">Selesai</p>
                            <div class="d-flex gap-2">
                                <span class="fs-3 fw-bold">4</span>
                                <span class="d-flex align-items-end fw-bold">
                                    <i class="bi bi-caret-up-fill text-success fs-4"></i>
                                    <span class="text-success">+ 3 event</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex align-items-center gap-3 border-start border-end">
                        <img src="{{ asset('icon/berjalan.svg') }}" alt="icon">
                        <div class="">
                            <p style="margin: 0;" class="fw-bold">Berjalan</p>
                            <div class="d-flex gap-2">
                                <span class="fs-3 fw-bold">8</span>
                                <span class="d-flex align-items-end fw-bold">
                                    <i class="bi bi-caret-down-fill text-danger fs-4"></i>
                                    <span class="text-danger">- 7 event</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex align-items-center gap-3">
                        <img src="{{ asset('icon/total.svg') }}" alt="icon">
                        <div class="">
                            <p style="margin: 0;" class="fw-bold">Total</p>
                            <div class="d-flex gap-2">
                                <span class="fs-3 fw-bold">400</span>
                                <!-- <span class="d-flex align-items-end fw-bold">
                                    <i class="bi bi-caret-up-fill text-success fs-4"></i>
                                    <span class="text-success">+ 3 event</span>
                                </span> -->
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Chart -->
                <div class="row">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Event</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="4">Hari ini</option>
                                <option value="1">1 hari yang lalu</option>
                                <option value="2">1 Minggu yang lalu</option>
                                <option value="3">1 bulan yang lalu</option>
                            </select>
                        </div>
                    </div>
                    <canvas id="myChart" height="300"></canvas>
                </div>

            </div>
            <div class="col-md-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.60965050534!2d107.56075514178632!3d-6.903271952261035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1744268686448!5m2!1sid!2sid"
                    width="100%" height="350px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <iframe
                    src="https://calendar.google.com/calendar/embed?src=afrizalmuhammad656%40gmail.com&ctz=Asia%2FJakarta"
                    style="border: 0" width="100%" height="350" frameborder="0" scrolling="no"
                    class="mt-5"></iframe>

            </div>
        </div>
        <div class="row mt-5 w-100 aturEvent">
            <div class="row">
                <div class="col-10 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold">AKTIVITAS</h5>
                    <a href="{{ route('aturEvent') }}">Atur Event</a>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row  mt-4">
                <div class="validates col-10 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="{{ asset('image/defaultProfile.png') }}" alt="profile" width="40">
                        <h5>MARI HIJAUKAN BUMI!!</h5>
                    </div>
                    <div class="status">
                        <div class="round d-flex gap-2">
                            <svg width="20" height="20">
                                <circle cx="10" cy="10" r="5" fill="red" />
                            </svg>
                            <h6 class="fw-bold">Belum Dikonfirmasi</h6>
                        </div>
                    </div>
                    <div class="jam d-flex align-items-center gap-2">
                        <p style="margin: 0;">4 jam yang lalu</p>
                        <img src="{{ asset('icon/settings.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row  mt-4">
                <div class="validates col-10 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="{{ asset('image/defaultProfile.png') }}" alt="profile" width="40">
                        <h5>Selamatkan laut</h5>
                    </div>
                    <div class="status">
                        <div class="round d-flex gap-2">
                            <svg width="20" height="20">
                                <circle cx="10" cy="10" r="5" fill="lightgreen" />
                            </svg>
                            <h6 class="fw-bold">Sedang Berjalan</h6>
                        </div>
                    </div>
                    <div class="jam d-flex align-items-center gap-2">
                        <p style="margin: 0;">9 jam yang lalu</p>
                        <img src="{{ asset('icon/settings.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row  mt-4">
                <div class="validates col-10 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="{{ asset('image/defaultProfile.png') }}" alt="profile" width="40">
                        <h5>Bantu Anak Anak Ini Untuk Makan</h5>
                    </div>
                    <div class="status">
                        <div class="round d-flex gap-2">
                            <svg width="20" height="20">
                                <circle cx="10" cy="10" r="5" fill="orange" />
                            </svg>
                            <h6 class="fw-bold">Sudah Dikonfirmasi</h6>
                        </div>
                    </div>
                    <div class="jam d-flex align-items-center gap-2">
                        <p style="margin: 0;">5 jam yang lalu</p>
                        <img src="{{ asset('icon/settings.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function updateDropdown(value) {
            document.getElementById('dropdownButton').innerText = value;
        }

        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                datasets: [{
                        label: 'Event A',
                        data: [3, 7, 5, 10, 6, 5, 8],
                        borderColor: '#4ADE80', // hijau
                        backgroundColor: 'rgba(74, 222, 128, 0.1)', // hijau soft
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4ADE80',
                        borderWidth: 2
                    },
                    {
                        label: 'Event B',
                        data: [2, 4, 6, 5, 7, 4, 9],
                        borderColor: '#F87171', // merah
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0.4,
                        pointRadius: 0,
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: () => '',
                            label: function(context) {
                                return `${context.parsed.y} Event`;
                            }
                        },
                        backgroundColor: '#1E293B',
                        titleFont: {
                            weight: 'bold'
                        },
                        bodyFont: {
                            weight: 'bold'
                        },
                        padding: 8,
                        cornerRadius: 6
                    }
                },
                scales: {
                    y: {
                        type: 'logarithmic',
                        min: 1,
                        max: 50,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(Math.log10(value)) ? value : '';
                            }
                        },
                        grid: {
                            color: '#e5e7eb'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>



    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
