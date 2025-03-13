<x-app-layout>

    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            * {
                color: black;
            }
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  dark: leading-tight">
            {{ __('Buat Event Baru') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-white-800 py-12 px-6">
        <div class="max-w-3xl mx-aut p-8 rounded-lg">
            <h2 class="text-3xl font-semibold  mb-6">Buat Event Baru</h2>

            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <input type="hidden" name="host" value="{{ auth()->id() }}">
                </div>

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium ">Nama Event</label>
                    <input type="text" name="nama" id="nama" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('nama') border-red-500 @enderror" placeholder="Masukkan nama event" value="{{ old('nama') }}">
                    @error('nama')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium ">Tags</label>
                    <select name="tags" id="tags" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('tags') border-red-500 @enderror">
                        <option value="kemanusiaan">Kemanusiaan</option>
                        <option value="lingkungan">Lingkungan</option>
                        <option value="olahraga">Olahraga</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="lokasi_map" class="block text-sm font-medium ">Pilih Lokasi Event</label>
                    <div id="lokasi_map" class="w-full h-64 rounded-md shadow-md"></div>
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                    <label for="alamat" class="block text-sm font-medium  mt-4">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="w-full px-4 py-2  bg-gray-200 rounded-md" readonly>
                    <p class="text-sm  mt-2">Klik di peta untuk memilih lokasi.</p>
                </div>

                <div class="mb-4">
                    <label for="tanggal_mulai" class="block text-sm font-medium ">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('tanggal_mulai') border-red-500 @enderror" value="{{ old('tanggal_mulai') }}">
                    @error('tanggal_mulai')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_selesai" class="block text-sm font-medium ">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('tanggal_selesai') border-red-500 @enderror" value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="event_image" class="block text-sm font-medium ">Upload Gambar Event</label>
                    <input type="file" name="event_image[]" id="event_image" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('event_image') border-red-500 @enderror" multiple>
                    @error('event_image')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="event_detail" class="block text-sm font-medium ">Detail Event</label>
                    <textarea name="event_detail" id="event_detail" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('event_detail') border-red-500 @enderror" rows="5" placeholder="Masukkan detail event">{{ old('event_detail') }}</textarea>
                    @error('event_detail')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="requirement" class="block text-sm font-medium ">Kebutuhan Event</label>
                    <textarea name="requirement" id="requirement" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('requirement') border-red-500 @enderror" rows="5" placeholder="Masukkan kebutuhan event">{{ old('requirement') }}</textarea>
                    @error('requirement')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="target_donasi" class="block text-sm font-medium ">Target Donasi</label>
                    <input type="number" name="target_donasi" id="target_donasi" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('target_donasi') border-red-500 @enderror" placeholder="Masukkan target donasi" value="{{ old('target_donasi') }}">
                    @error('target_donasi')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Simpan Event
                    </button>
                </div>
            </form>
        </div>
    </div>
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
</x-app-layout>