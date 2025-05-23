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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Event') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-white-800 py-12 px-6">
        <div class="max-w-3xl mx-auto bg-gray-700 p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-100 mb-6">Update Event</h2>
            
            <form action="{{ route('event.update', $event->id_event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Host ID (Auto set to Auth User) -->
                <input type="hidden" name="host" value="{{ auth()->id() }}">

                <!-- Nama Event -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-200">Nama Event</label>
                    <input type="text" name="nama" id="nama" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('nama') border-red-500 @enderror" placeholder="Masukkan nama event" value="{{ old('nama', $event->nama) }}">
                    @error('nama')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-200">Tags</label>
                    <select name="tags" id="tags" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('tags') border-red-500 @enderror">
                        <option value="kemanusiaan" {{ old('tags', $event->tags) == 'kemanusiaan' ? 'selected' : '' }}>Kemanusiaan</option>
                        <option value="lingkungan" {{ old('tags', $event->tags) == 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                        <option value="olahraga" {{ old('tags', $event->tags) == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="mb-4">
                    <label for="lokasi" class="block text-sm font-medium text-gray-200">Lokasi Event</label>
                    <div id="lokasi_map" class="w-full h-64 rounded-md shadow-md"></div>
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                    <input type="text" name="alamat" id="alamat" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('alamat') border-red-500 @enderror" placeholder="Masukkan lokasi event" value="{{ old('alamat', $event->alamat) }}">
                    @error('alamat')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-4">
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-200">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('tanggal_mulai') border-red-500 @enderror" value="{{ old('tanggal_mulai', $event->tanggal_mulai) }}">
                    @error('tanggal_mulai')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Selesai -->
                <div class="mb-4">
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-200">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('tanggal_selesai') border-red-500 @enderror" value="{{ old('tanggal_selesai', $event->tanggal_selesai) }}">
                    @error('tanggal_selesai')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Event Image -->
                <div class="mb-4">
                    <label for="event_image" class="block text-sm font-medium text-gray-200">Upload Gambar Event</label>
                    <input type="file" name="event_image[]" id="event_image" accept="image/*" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('event_image') border-red-500 @enderror" multiple>
                    @error('event_image')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                 <!-- 360 Image -->
                <div class="mb-4">
                    <label for="vr_image" class="block text-sm font-medium ">Upload Gambar Event 360</label>
                    <input type="file" name="vr_image" id="vr_image" accept="image/*" class="mt-1 block w-full px-4 py-2  bg-gray-200 rounded-md @error('vr_image') border-red-500 @enderror">
                    @error('vr_image')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Detail Event -->
                <div class="mb-4">
                    <label for="event_detail" class="block text-sm font-medium text-gray-200">Detail Event</label>
                    <textarea name="event_detail" id="event_detail" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('event_detail') border-red-500 @enderror" rows="5" placeholder="Masukkan detail event">{{ old('event_detail', $event->event_detail) }}</textarea>
                    @error('event_detail')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Requirements -->
                <div class="mb-4">
                    <label for="requirement" class="block text-sm font-medium text-gray-200">Kebutuhan Event</label>
                    <textarea name="requirement" id="requirement" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('requirement') border-red-500 @enderror" rows="5" placeholder="Masukkan kebutuhan event">{{ old('requirement', $event->requirement) }}</textarea>
                    @error('requirement')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Target Donasi -->
                <div class="mb-4">
                    <label for="target_donasi" class="block text-sm font-medium text-gray-200">Target Donasi</label>
                    <input type="number" name="target_donasi" id="target_donasi" class="mt-1 block w-full px-4 py-2 text-gray-800 bg-gray-200 rounded-md @error('target_donasi') border-red-500 @enderror" placeholder="Masukkan target donasi" value="{{ old('target_donasi', $event->target_donasi) }}">
                    @error('target_donasi')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CKEditor Script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#event_detail'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#requirement'))
            .catch(error => {
                console.error(error);
            });

        document.addEventListener("DOMContentLoaded", function() {
            const latitude = {{ $event->latitude ?? 0 }};
            const longitude = {{ $event->longitude ?? 0 }};

            const map = L.map('lokasi_map').setView([latitude, longitude], 13);

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

                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        const alamat = data.display_name || "Alamat tidak ditemukan";
                        document.getElementById('lokasi').value = alamat;
                    })
                    .catch(error => {
                        console.error('Error fetching alamat:', error);
                        document.getElementById('lokasi').value = "Gagal mendapatkan alamat";
                    });

                marker.on('dragend', function(e) {
                    const position = marker.getLatLng();
                    document.getElementById('latitude').value = position.lat;
                    document.getElementById('longitude').value = position.lng;
                    updateMarker(position.lat, position.lng);
                });
            }

            updateMarker(latitude, longitude);

            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                updateMarker(lat, lng);
            });
        });
    </script>
</x-app-layout>
