<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .line-clamp-2,
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-box-orient: vertical;
                overflow: hidden;
                line-height: 1.5;
            }

            .line-clamp-2 {
                -webkit-line-clamp: 2;
                min-height: calc(1.5em * 2);
            }

            .line-clamp-3 {
                -webkit-line-clamp: 3;
                min-height: calc(1.5em * 3);
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
                @if ($event->status === 'approved' || auth()->id() === $event->host)
                    @php
                        $eventImages = json_decode($event->event_image);
                        $cardImage = is_array($eventImages) && count($eventImages) ? $eventImages[0] : null;
                    @endphp

                    <div
                        class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[2rem] overflow-hidden shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                        <div class="relative overflow-hidden">
                            <a href="{{ route('event.show', $event->id_event) }}">
                                <img src="{{ $cardImage ? asset('storage/' . $cardImage) : asset('images/default-event.jpg') }}"
                                    alt="{{ $event->nama }}"
                                    class="w-full h-64 object-cover transition duration-500 ease-in-out transform group-hover:scale-105">
                            </a>
                            <div
                                class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/80 via-slate-950/10 to-transparent p-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-800 bg-emerald-100 rounded-full dark:bg-emerald-900 dark:text-emerald-200">
                                    {{ ucfirst($event->tags) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $event->nama }}</h3>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Hosted by
                                        {{ $event->user->username }}</p>
                                </div>
                                @if ($event->status !== 'approved')
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                                <div class="flex flex-wrap gap-3">
                                    <span class="inline-flex items-center gap-2">
                                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                                    </span>
                                    <span class="inline-flex items-center gap-2">
                                        {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                                    </span>
                                </div>
                                <div>
                                    {{ $event->alamat ?? $event->lokasi }}
                                </div>
                            </div>

                            <p class="mt-4 text-slate-600 dark:text-slate-300 text-sm line-clamp-3">
                                {{ Str::limit(strip_tags($event->event_detail), 120) }}
                            </p>

                            <div class="mt-5">
                                <div class="flex items-center justify-between gap-4 text-sm text-slate-600 dark:text-slate-300">
                                    <span class="font-semibold">Progress</span>
                                    <span>{{ $event->progress_event }}%</span>
                                </div>
                                <div class="mt-2 h-3 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                                    <div class="h-full rounded-full bg-emerald-500"
                                        style="width: {{ $event->progress_event }}%;"></div>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <a href="{{ route('event.show', $event->id_event) }}"
                                    class="inline-flex items-center justify-center rounded-full border border-emerald-500 bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-500 hover:text-white transition">
                                    View Details
                                </a>

                                @if (auth()->id() === $event->host)
                                    <div class="flex flex-wrap gap-3">
                                        @if(auth()->user()->canany(['event-edit']))
                                            <a href="{{ route('event.edit', $event->id_event) }}"
                                                class="inline-flex items-center justify-center rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 transition">
                                                Edit
                                            </a>
                                        @endif
                                        @if(auth()->user()->canany(['event-delete']))
                                            <form action="{{ route('event.destroy', $event->id_event) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <p class="empty-event text-center text-slate-600 dark:text-slate-300">Waduh, saat ini tidak ada event yang
                    sedang berjalan.</p>
            @endforelse
        </div>




    </div>
</x-app-layout>