<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/font.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<nav class="sticky-top" style="backdrop-filter: blur(10px);">
    <div class="row navbar pt-3 pb-3">
        <div class="col">
            <div class="judul d-flex pt-2 pb-2 align-items-center">
                <a href="{{ route('home') }}" class="d-flex align-items-center">
                    <img src="{{ asset('icon/1.svg') }}" alt="icon">
                    <h5>Voluntrack.</h5>
                </a>
            </div>
        </div>
        <div class="col-lg-8 d-flex justify-content-center">
            <div class="navigasi d-flex align-items-center">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('dashboard') }}">Admin</a></li>
                    <li><a href="{{ route('admin.dashboard') }}">Approval</a></li>
                    {{-- <li><a href="{{ Request::is('home') ? '#page3' : url('/home#page3') }}">Kegiatan</a></li> --}}
                    <li><a href="{{ route('merchant.index') }}">Merchant</a></li>
                </ul>
            </div>
        </div>
        <div class="col d-flex justify-content-end pe-0">
            <div class="akun d-flex align-items-center">
                @auth
                    <!-- Jika User Sudah Login -->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('profileUser') }}"
                            class="d-flex align-items-center text-decoration-none text-dark">
                            @if (Auth::user()->profile)
                                <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profil"
                                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                            @else
                                <img src="{{ asset('image/defaultProfile.png') }}" alt=""
                                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                            @endif
                            <span class="fw-bold">{{ Auth::user()->username }}</span>
                        </a>
                    </div>
                @else
                    <!-- Jika User Belum Login -->
                    <button><a href="{{ route('login') }}" target="_blank">Masuk</a></button>
                    <button style="background-color: #AEF161; color: black;"><a href="{{ route('register') }}">Daftar</a></button>
                @endauth
            </div>
        </div>
    </div>
</nav>
