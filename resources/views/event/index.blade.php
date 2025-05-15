<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                /* Membatasi maksimal 2 baris */
                -webkit-box-orient: vertical;
                overflow: hidden;
                /* Memastikan teks tambahan tidak terlihat */
                line-height: 1.5;
                /* Atur tinggi baris */
                min-height: calc(1.5em * 2);
                /* Pastikan ruang minimal untuk 2 baris */
            }
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Voluntrack Events') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-6 mt-5">
        <div class="row row1">
            <div class="col judul">
                <h5 class="font-bold">KEGIATAN</h5>
            </div>
        </div>
        <div class="row row2">
            <div class="col search">
                <div class="input-group">
                    <form action="{{ route('event.index') }}" method="get">
                        <div class="d-flex">
                            <div class="search d-flex align-items-center border" style="width: 500px;">
                                <span class="p-2"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control border-0" name="search" id="search"
                                    placeholder="Tuliskan disini" aria-label="Search" aria-describedby="searchIcon"
                                    value="{{ request()->search }}">
                            </div>
                            <!-- <select name="category" id="category" style="width: 100px; border:none; font-size: .8em;"
                                class="border p-2">
                                <option value="null">Category</option>
                                <option value="Kemanusiaan">Kemanusiaan</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Keuangan">Keuangan</option>
                            </select>
                            <select name="order" id="order" style="width: 100px; border:none; font-size: .8em;"
                                class="border p-2">
                                <option value="null">Order by</option>
                                <option value="Terbaru">Terbaru</option>
                                <option value="Terlama">Terlama</option>
                            </select> -->
                            <button type="submit" name="filter" value="Submit" class="ms-3"
                                style="width:100px; border:none; border-radius:10px; background-color:#AEF161; font-family: 'jakartaSansBold'">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col create d-flex justify-content-end align-items-end">
                <p>Ingin Membuat Kegiatan?
                    <u>
                        @if(auth()->user()->canany(['event-create']))
                        <a href="{{ route('event.create') }}" style="color:#258D00; font-weight:bold">Buat disini</a>
                        @endif
                    </u>
                </p>
            </div>
        </div>




        <!-- awal ui card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-5">
            @forelse ($events as $event)
            @if ($event->status === 'approved')
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">


                @if (auth()->id() === $event->host)
                <p class="text-green-500">Status : {{$event->status}}</p>
                @endif
                <a href="{{ route('event.show', $event->id_event) }}">
                    <img src="{{ asset('storage/' . json_decode($event->event_image)[0]) }}" alt="{{ $event->nama }}"
                        class="w-full h-48 object-cover">
                </a>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 mt-2">
                        <a href="{{ route('event.show', $event->id_event) }}"
                            class="text-gray-900 no-underline font-bold">{{ $event->nama }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Hosted by: <span
                            class="font-medium text-blue-500">{{ $event->user->username }}</span></p>
                    <div class="flex justify-between mt-4">
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Start: {{
                            \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</span>
                        <span class="text-gray-600 dark:text-gray-400 text-sm">End: {{
                            \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</span>
                    </div>
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm">Location: <span
                            class="font-medium text-blue-500">{{ $event->lokasi }}</span></p>
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm line-clamp-2">{{
                        Str::limit(strip_tags($event->event_detail), 100) }}</p>
                    <div class="mt-2">
                        <p>Progress :</p>
                        <div class="relative w-full h-6 bg-gray-200 rounded-full overflow-hidden">

                            <div class="abosulute top-0 left-0 h-6 bg-blue-500"
                                style="width: {{ $event->progress_event}}%;"></div>
                            <p class="text-sm text-gray-700 absolute top-0 left-1/2 transform -translate-x-1/2 mt-1">
                                {{ $event->progress_event }}%
                            </p>
                        </div>


                    </div>

                    @if (auth()->id() === $event->host)
                    <div class="flex justify-between items-center mt-6">
                        @if(auth()->user()->canany(['event-show']))
                        <a href="{{ route('event.show', $event->id_event) }}"
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-500">View Details</a>
                        @endif
                        <div class="flex space-x-3">
                            @if(auth()->user()->canany(['event-edit']))
                            <a href="{{ route('event.edit', $event->id_event) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-500">Edit</a>
                            @endif
                            @if(auth()->user()->canany(['event-delete']))
                            <form action="{{ route('event.destroy', $event->id_event) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-500">Delete</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @elseif ($event->status === 'pending' || $event->status === 'rejected')
            <!-- Menampilkan event yang statusnya pending atau rejected hanya untuk host -->
            @if (auth()->id() === $event->host)
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                @if (auth()->id() === $event->host)
                <p class="text-green-500">Status : {{$event->status}}</p>
                @endif
                <a href="{{ route('event.show', $event->id_event) }}">
                    <img src="{{ asset('storage/' . json_decode($event->event_image)[0]) }}" alt="{{ $event->nama }}"
                        class="w-full h-48 object-cover">
                </a>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 mt-2">
                        <a href="{{ route('event.show', $event->id_event) }}"
                            class="text-gray-900 no-underline font-bold">{{ $event->nama }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Hosted by: <span
                            class="font-medium text-blue-500">{{ $event->user->username }}</span></p>
                    <div class="flex justify-between mt-4">
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Start: {{
                            \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</span>
                        <span class="text-gray-600 dark:text-gray-400 text-sm">End: {{
                            \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</span>
                    </div>
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm">Location: <span
                            class="font-medium text-blue-500">{{ $event->lokasi }}</span></p>
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm line-clamp-2">{{
                        Str::limit(strip_tags($event->event_detail), 100) }}</p>
                    <div class="mt-2">
                        <p>Progress :</p>
                        <div class="relative w-full h-6 bg-gray-200 rounded-full overflow-hidden">

                            <div class="abosulute top-0 left-0 h-6 bg-blue-500"
                                style="width: {{ $event->progress_event}}%;"></div>
                            <p class="text-sm text-gray-700 absolute top-0 left-1/2 transform -translate-x-1/2 mt-1">
                                {{ $event->progress_event }}%
                            </p>
                        </div>


                    </div>

                    <div class="flex justify-between items-center mt-6">
                        @if(auth()->user()->canany(['event-show']))
                        <a href="{{ route('event.show', $event->id_event) }}"
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-500">View Details</a>
                        @endif
                        <div class="flex space-x-3">
                            @if(auth()->user()->canany(['event-edit']))
                            <a href="{{ route('event.edit', $event->id_event) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-500">Edit</a>
                            @endif
                            @if(auth()->user()->canany(['event-delete']))
                            <form action="{{ route('event.destroy', $event->id_event) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-500">Delete</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
            @empty
            <p class="empty-event">Waduh, saat ini tidak ada event yang sedang berjalan.</p>
            @endforelse
        </div>




    </div>
</x-app-layout>