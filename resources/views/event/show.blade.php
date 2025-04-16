<x-app-layout>

    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <link rel="stylesheet" href="{{ asset('css/eventDetail.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            #map {
                border-radius: 10px;
                margin-top: 10px;
            }
        </style>

    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <main id="page1" style="padding: 0;">
        <div class="row">
            <div class="col-8 left">
                <div class="more-img mt-3 d-flex justify-content-between me-4 border" style="height: 400px;">
                    @foreach (json_decode($event->event_image) as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="w-100 h-100 rounded-lg" alt="Event Image"
                            style="object-fit: cover;">
                    @endforeach
                </div>
            </div>
            {{-- kanan --}}
            <div class="col-4 right shadow-md">
                <h4>{{ $event->nama }}</h4>
                <p class="mt-4" style="font-size: 1.1em;">Detail Kegiatan</p>
                <p>Waktu :</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</p>

                <p>Alamat :</p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><span
                        class="font-medium text-blue-500">{{ $event->alamat }}</span></p>
                <div id="map" style="height: 200px; width: 100%;"></div>

                <p class="mt-4" style="font-size: 1.1em;">Kategori Kegiatan :</p>
                <div class="kategori kategori4 d-flex justify-content-center align-items-center">
                    <span>{{ $event->tags }}</span>
                </div>
                <div class="progres pt-4">
                    <div class="relative w-full h-6 bg-gray-200 rounded-full overflow-hidden">
                        <div class="absolute top-0 left-0 h-6 bg-blue-500"
                            style="width: {{ $event->progress_event }}%;"></div>
                        <p class="text-sm text-gray-700 absolute top-0 left-1/2 transform -translate-x-1/2 mt-1">
                            {{ $event->progress_event }}%
                        </p>
                    </div>
                </div>

                @if (auth()->id() != $event->host)
                    @if ($event->progress_event != 100)
                        <div class="mt-8 mb-3">
                            <a href="{{ route('donasi', ['event' => $event->id_event]) }}"
                                class="inline-block bg-[#AEF161] text-black px-6 py-3 rounded-lg text-lg font-semibold hover:bg-green-500 transition duration-300 w-full text-center no-underline ">
                                Donasi Sekarang

                            </a>
                        </div>
                    @endif
                    {{-- button daftar --}}
                    @if ($event->relawan->contains('user_id', auth()->id()))
                        <div class="mt-8">
                            <p class="text-green-500">Anda sudah menjadi relawan untuk event ini!</p>
                        </div>
                    @else
                        @if (auth()->user()->canany(['relawan-daftar']))
                            @if (auth()->user()->nik && auth()->user()->no_hp && auth()->user()->alamat && auth()->user()->ktp)
                                <div class="mt-8">
                                    <a href="{{ route('relawan.daftar', ['event' => $event->id_event]) }}"
                                        class="w-full inline-block text-center no-underline bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-500 transition duration-300">
                                        Daftar sebagai Relawan
                                    </a>
                                </div>
                            @else
                                <div class="mt-8">
                                    <a href="{{ route('profile.edit') }}"
                                        class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-red-500 transition duration-300 w-full no-underline text-center">
                                        Lengkapi Profil untuk Mendaftar
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                <div class="mt-8">
                    <a href=""
                        class="w-full inline-block text-center no-underline bg-[#F3FFEB] text-[#7E9C5C] border-2 border-[#7E9C5C] px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#AEF161] hover:text-white transition duration-300">
                        <i class="fa-solid fa-vr-cardboard"></i> Lihat Lokasi
                    </a>
                </div>
                @endif


                {{-- para donatur --}}
                <p class="mt-5">Para Donatur :</p>
                <div class="mt-6 p-2 bg-slate-100 rounded-md h-56 overflow-y-auto font-bold">
                    @foreach ($donaturs as $donatur)
                           <p>{{$donatur->user->username ?? "Anonim"}}</p> 
                    @endforeach
                </div>

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
        <div class="row mb-5">
            <div class="col-8">
                <p class="deskripsi">Deskripsi Kegiatan</p>
                <p>{{ $event->event_detail }}</p>

                <p class="kebutuhan mt-5">Kebutuhan Kegiatan</p>
                <p>{{ $event->requirement }}</p>

                <p class="para-relawan mt-5">Para Relawan</p>
                <div class="mt-6">
                    <ol class="list-inside list-decimal">
                        @foreach ($relawans as $relawan)
                            <li class="text-gray-600 dark:text-gray-400">{{ $relawan->nama_lengkap }}</li>
                        @endforeach
                    </ol>
                </div>

            </div>
        </div>
    </main>

    <!-- Akhir ui -->



    @if ($event->latitude && $event->longitude)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const latitude = @json($event->latitude);
                const longitude = @json($event->longitude);
                const map = L.map('map').setView([latitude, longitude], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([latitude, longitude]).addTo(map).bindPopup('Lokasi Kegiatan!').openPopup();

                window.addEventListener("resize", function() {
                    map.invalidateSize();
                });
            });
        </script>
    @else
        <p class="text-gray-600 dark:text-gray-400">Lokasi tidak tersedia.</p>
    @endif
</x-app-layout>
