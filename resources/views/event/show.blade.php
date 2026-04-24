<x-app-layout>

    <head>
        <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <link rel="stylesheet" href="{{ asset('css/eventDetail.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
        <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
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

    <main id="page1" class="max-w-7xl mx-auto px-4 py-8">
        @php
$images = json_decode($event->event_image, true) ?: [];
$mainImage = $images[0] ?? null;
        @endphp

        <div class="flex flex-col gap-8 lg:flex-row">
            <div class="w-full lg:w-2/3 space-y-6">
                <div
                    class="rounded-3xl overflow-hidden border border-slate-200 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-900">
                    <img src="{{ $mainImage ? asset('storage/' . $mainImage) : asset('images/default-event.jpg') }}"
                        alt="{{ $event->nama }}" class="w-full h-[420px] object-cover">
                </div>

                @if(count($images) > 1)
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($images as $index => $image)
                            @if($index > 0)
                                <div
                                    class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $event->nama }}"
                                        class="w-full h-32 object-cover transition duration-300 hover:scale-105">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <div
                    class="rounded-3xl overflow-hidden border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Virtual
                                Tour</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Lihat suasana langsung</h2>
                        </div>
                        <span
                            class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200">360°</span>
                    </div>
                    <div id="panorama-container" class="mt-6 h-[360px] overflow-hidden rounded-[1.5rem] bg-black">
                        <div id="panorama" class="h-full w-full"></div>
                    </div>
                    <div id="vr-scene-container" class="mt-6 hidden h-[360px] overflow-hidden rounded-[1.5rem]"></div>
                </div>
                <div class="w-full lg:w-2/3">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                        <h3 class="text-2xl font-bold text-slate-900">Deskripsi Kegiatan</h3>
                        <p class="mt-4 text-slate-600 dark:text-slate-300 leading-relaxed">{{ $event->event_detail }}</p>
                
                        <h3 class="mt-8 text-2xl font-bold text-slate-900">Kebutuhan Kegiatan</h3>
                        <p class="mt-4 text-slate-600 dark:text-slate-300 leading-relaxed">{{ $event->requirement }}</p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 space-y-6">
                <div
                    class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                    <h3 class="text-2xl font-bold text-slate-900">{{ $event->nama }}</h3>
                    <p class="mt-3 text-slate-600 dark:text-slate-300">Detail Kegiatan</p>

                    <div class="mt-6 space-y-4 text-sm text-slate-700 dark:text-slate-300">
                        <div>
                            <p class="font-semibold text-slate-900">Waktu</p>
                            <p>{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Alamat</p>
                            <p class="text-blue-600 dark:text-blue-300">{{ $event->alamat }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Kategori</p>
                            <span
                                class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200">{{ ucfirst($event->tags) }}</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-400">
                            <span class="font-semibold">Progress</span>
                            <span>{{ $event->progress_event }}%</span>
                        </div>
                        <div class="mt-2 h-3 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                            <div class="h-full rounded-full bg-blue-500" style="width: {{ $event->progress_event }}%;">
                            </div>
                        </div>
                    </div>

                    <div id="map" class="mt-6 h-48 w-full rounded-3xl border border-slate-200 dark:border-slate-700">
                    </div>
                </div>

                <div
                    class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                    @if (auth()->id() != $event->host)
                        @if ($event->progress_event != 100)
                            <a href="{{ route('donasi', ['event' => $event->id_event]) }}"
                                class="block w-full rounded-3xl bg-emerald-500 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-emerald-400">
                                Donasi Sekarang
                            </a>
                        @endif

                        @if ($event->relawan->contains('user_id', auth()->id()))
                            <div class="mt-4 rounded-3xl bg-emerald-50 p-4 text-sm font-semibold text-emerald-700">Anda sudah
                                terdaftar sebagai relawan.</div>
                        @else
                            @if (auth()->user()->canany(['relawan-daftar']))
                                @if (auth()->user()->nik && auth()->user()->no_hp && auth()->user()->alamat && auth()->user()->ktp)
                                    <a href="{{ route('relawan.daftar', ['event' => $event->id_event]) }}"
                                        class="block w-full rounded-3xl bg-blue-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-blue-500">
                                        Daftar sebagai Relawan
                                    </a>
                                @else
                                    <a href="{{ route('profile.edit') }}"
                                        class="block w-full rounded-3xl bg-red-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-red-500">
                                        Lengkapi Profil untuk Mendaftar
                                    </a>
                                @endif
                            @endif
                        @endif
                    @endif
                    <a href="#panorama-container"
                        class="mt-4 inline-flex w-full items-center justify-center rounded-3xl border border-emerald-500 bg-emerald-50 px-5 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-500 hover:text-white">
                        <i class="fa-solid fa-vr-cardboard mr-2"></i> Lihat Lokasi
                    </a>
                </div>

                <div
                    class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                    <h3 class="text-lg font-semibold text-slate-900">Para Donatur</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        @forelse ($donaturs as $donatur)
                            <div class="rounded-2xl bg-slate-100 p-3 dark:bg-slate-800">
                                {{ $donatur->user->username ?? 'Anonim' }}</div>
                        @empty
                            <p class="text-slate-500 dark:text-slate-400">Belum ada donatur.</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-900">
                    <h3 class="text-2xl font-bold text-slate-900">Para Relawan</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        @forelse ($relawans as $relawan)
                            <div class="rounded-2xl bg-slate-100 p-3 dark:bg-slate-800">{{ $relawan->nama_lengkap }}</div>
                        @empty
                            <p class="text-slate-500 dark:text-slate-400">Belum ada relawan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-8 lg:flex-row">

        </div>
    </main>

    <!-- Akhir ui -->



    @if ($event->latitude && $event->longitude)
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const latitude = @json($event->latitude);
                const longitude = @json($event->longitude);
                const map = L.map('map').setView([latitude, longitude], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([latitude, longitude]).addTo(map).bindPopup('Lokasi Kegiatan!').openPopup();

                window.addEventListener("resize", function () {
                    map.invalidateSize();
                });
            });
        </script>
    @else
        <p class="text-gray-600 dark:text-gray-400">Lokasi tidak tersedia.</p>
    @endif

    <script>
        async function supportsWebXR() {
            if (navigator.xr) {
                try {
                    const isVRSupported = await navigator.xr.isSessionSupported('immersive-vr');
                    console.log("WebXR is Supported");

                    if (isVRSupported) {
                        try {
                            const session = await navigator.xr.requestSession('immersive-vr');
                            console.log("Perangkat VR berhasil terhubung");
                            return true;
                        } catch (err) {
                            console.warn("Gagal memulai sesi VR:", err);
                            return false;
                        }
                    } else {
                        console.log("VR tidak terkoneksi!");
                    }
                } catch (err) {
                    console.warn("WebXR not supported:", err);
                    return false;
                }
            }
            return false;
        }

        document.addEventListener("DOMContentLoaded", async function () {
            const isVRAvailable = await supportsWebXR();

            if (isVRAvailable) {
                document.getElementById("vr-scene-container").style.display = "block";
                document.getElementById("panorama-container").style.display = "none";
            } else {
                pannellum.viewer('panorama', {
                    "type": "equirectangular",
                    "panorama": "{{ Storage::url($event->vr_image) }}",
                    "autoLoad": true
                });
            }
        });
    </script>
</x-app-layout>