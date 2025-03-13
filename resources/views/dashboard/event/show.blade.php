<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            #map{
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

    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <p class="text-green-500">Status : {{$event->status}}</p>
            <div class="flex items-center mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        @foreach (json_decode($event->event_image) as $image)
                            <img src="{{ asset('storage/' . $image) }}" class="w-full rounded-lg w-54 h-52" alt="Event Image">
                        @endforeach
                </div>
            </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $event->nama }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Hosted by: <span class="font-medium text-blue-500">{{ $event->user->username }}</span>
                </p>

            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2 mt-5">Description</h4>
                <p class="text-gray-700 dark:text-gray-300">{{ $event->event_detail }}</p>
            </div>

            <div class="mb-6">
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-5">
                    <p class="text-sm text-gray-600 dark:text-gray-400">🗓️ Event Dates</p>
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                    </h5>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400">📍 Location</p>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
                
            </div>

            <!-- Event Requirements -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Requirements</h4>
                <p class="text-gray-700 dark:text-gray-300">{{ $event->requirement }}</p>
            </div>

            <!-- Target Donation -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Target Donation</h4>
                <p class="text-gray-700 dark:text-gray-300">Rp {{ number_format($event->target_donasi, 0, ',', '.') }}</p>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4">
                <form action="{{ route('admin.event.approve', $event->id_event) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-green-500 transition">
                        Approve
                    </button>
                </form>
                <form action="{{ route('admin.event.reject', $event->id_event) }}" method="POST" onsubmit="return confirm('Are you sure to reject this event?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-red-500 transition">
                        Reject
                    </button>
                </form>
            </div>
        </div>

        <!-- Relawan Section -->
        @if ($relawans->count() > 0)
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Relawan List</h3>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <ul class="space-y-4">
                    @foreach ($relawans as $relawan)
                    <li class="flex items-center justify-between">
                        <div>
                            <h5 class="text-sm font-medium text-gray-800 dark:text-white">{{ $relawan->nama }}</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $relawan->email }}</p>
                        </div>
                        <span class="text-gray-600 dark:text-gray-400 text-sm">{{ $relawan->created_at->diffForHumans() }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @else
        <div class="mt-8 text-center">
            <p class="text-gray-600 dark:text-gray-400">No relawans have registered for this event yet.</p>
        </div>
        @endif
    </div>
        @if ($event->latitude && $event->longitude)
        <script>
            document.addEventListener("DOMContentLoaded", function(){
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
