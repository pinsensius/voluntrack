<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Approval') }}
        </h2>
    </x-slot>
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

    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div>
            <button><a href="{{ route('dashboard') }}">Dashboard admin</a></button>
        </div>

        <div class="Events d-flex flex-column gap-4 mt-5">
            @foreach ($events as $event)
            <div class="row  w-100">
                <div class="col d-flex justify-content-between align-items-center">
                    <img src="{{ asset('storage/' . json_decode($event->event_image)[0]) }}" alt="profile" width="40">
                    <h5>{{$event->nama}}</h5>
                    <div class="status">
                        <div class="round d-flex gap-2">
                            @if($event->status == "pending")
                            <svg width="20" height="20">
                                <circle cx="10" cy="10" r="5" fill="yellow" />
                            </svg>
                            @elseif($event->status == "rejected")
                            <svg width="20" height="20">
                                <circle cx="10" cy="10" r="5" fill="red" />
                            </svg>
                            @elseif($event->status == "approved")
                            <svg width="20" height="20">
                                <circle cx="10" cy="10" r="5" fill="green" />
                            </svg>
                            @endif
                            <h6 class="fw-bold">{{ $event->status}}</h6>
                        </div>
                    </div>
                    <div class="button-action d-flex gap-4">
                        @if (auth()->user()->canany(['admin-show']))
                        <button class="rounded-3 px-4 py-2" style="width: 33%;">
                            <a href="{{ route('admin.event.show', $event->id_event) }}"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-500">View Details</a>
                        </button>
                        @endif
                        @if (auth()->user()->canany(['admin-approve', 'admin-reject']))
                        <form action="{{ route('admin.event.approve', $event->id_event) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="rounded-3 px-4 py-2" style="width: 33%;">Izinkan</button>
                        </form>
                        <form action="{{ route('admin.event.reject', $event->id_event) }}" method="POST"
                            onsubmit="return confirm('Are you sure to reject this event?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="rounded-3 px-4 py-2" style="width: 33%;">Hentikan</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- <!-- Event Feed -->
        <div class="space-y-6">
            @foreach ($events as $event)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <!-- Header -->
                    <p class="text-green-500">Status : {{ $event->status }}</p>

                    <div class="mb-4 flex">
                        <img src="{{ asset('storage/' . json_decode($event->event_image)[0]) }}"
                            alt="{{ $event->nama }}" class="w-72 h-52 rounded object-cover mr-4">

                        <div class="flex mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                    {{ $event->nama }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Hosted by: <span
                                        class="font-medium text-blue-500">{{ $event->user->username }}</span>

                                </p>
                                <span class="text-sm text-blue-500">🗓️
                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</span>

                                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mt-5">
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                                        {{ Str::limit(strip_tags($event->event_detail), 150) }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>



                    <div class="flex justify-between items-center mt-4">
                        @if (auth()->user()->canany(['admin-show']))
                            <a href="{{ route('admin.event.show', $event->id_event) }}"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-500">View Details</a>
                        @endif
                        <div class="flex space-x-3">
                            @if (auth()->user()->canany(['admin-approve', 'admin-reject']))
                                <form action="{{ route('admin.event.approve', $event->id_event) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-500">Approve</button>
                                </form>
                                <form action="{{ route('admin.event.reject', $event->id_event) }}" method="POST"
                                    onsubmit="return confirm('Are you sure to reject this event?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-500">Reject</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
</x-app-layout>
