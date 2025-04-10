<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .Events .row:nth-child(odd) {
            background-color: #f0f0f0;
            /* Warna untuk baris ganjil */
        }

        .Events .row:nth-child(even) {
            background-color: #ffffff;
            /* Warna untuk baris genap */
        }

        .Events .row {
            padding: 10px 0;
        }

        .button-action button {
            font-weight: bold;
            border: none;
        }

        .button-action button:nth-child(1) {
            background-color: #7D7C7C;
            color: white;
        }

        .button-action button:nth-child(2) {
            background-color: #AEF161;
            color: black;
        }

        .button-action button:nth-child(3) {
            background-color: #FF0000;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <x-navbar />
        <div class="mt-5" style="padding: 0 120px;">
            <h2 class="fw-bold">Atur Event Yuk!</h2>
            <div class="dropdown mt-4">
                <button id="dropdownButton" class="btn btn-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown('Sedang berjalan')">Sedang
                            berjalan</a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown('Dihentikan')">Dihentikan</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown('Approval')">Approval</a></li>
                </ul>
            </div>
            <div class="Events d-flex flex-column gap-4 mt-5">
                <div class="row  w-100">
                    <div class="col d-flex justify-content-between align-items-center">
                        <img src="{{ asset('image/defaultProfile.png') }}" alt="profile" width="40">
                        <h5>MARI HIJAUKAN BUMI!!</h5>
                        <div class="status">
                            <div class="round d-flex gap-2">
                                <svg width="20" height="20">
                                    <circle cx="10" cy="10" r="5" fill="lightgreen" />
                                </svg>
                                <h6 class="fw-bold">Sedang Berjalan</h6>
                            </div>
                        </div>
                        <div class="button-action d-flex gap-4">
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Lihat Formulir</button>
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Izinkan</button>
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Hentikan</button>
                        </div>
                    </div>
                </div>
                <div class="row  w-100">
                    <div class="col d-flex justify-content-between align-items-center">
                        <img src="{{ asset('image/defaultProfile.png') }}" alt="profile" width="40">
                        <h5>MARI HIJAUKAN BUMI!!</h5>
                        <div class="status">
                            <div class="round d-flex gap-2">
                                <svg width="20" height="20">
                                    <circle cx="10" cy="10" r="5" fill="lightgreen" />
                                </svg>
                                <h6 class="fw-bold">Sedang Berjalan</h6>
                            </div>
                        </div>
                        <div class="button-action d-flex gap-4">
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Lihat Formulir</button>
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Izinkan</button>
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Hentikan</button>
                        </div>
                    </div>
                </div>
                <div class="row  w-100">
                    <div class="col d-flex justify-content-between align-items-center">
                        <img src="{{ asset('image/defaultProfile.png') }}" alt="profile" width="40">
                        <h5>MARI HIJAUKAN BUMI!!</h5>
                        <div class="status">
                            <div class="round d-flex gap-2">
                                <svg width="20" height="20">
                                    <circle cx="10" cy="10" r="5" fill="lightgreen" />
                                </svg>
                                <h6 class="fw-bold">Sedang Berjalan</h6>
                            </div>
                        </div>
                        <div class="button-action d-flex gap-4">
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Lihat Formulir</button>
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Izinkan</button>
                            <button class="rounded-3 px-4 py-2" style="width: 33%;">Hentikan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>