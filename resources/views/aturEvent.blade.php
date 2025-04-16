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
</head>

<body>
    <div class="container-fluid">
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
        </div>
    </div>
</x-app-layout>