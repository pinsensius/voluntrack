<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Approval') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div>
            <button><a href="{{ route('dashboard') }}">Dashboard admin</a></button>
        </div>
        <!-- Search Bar -->
        <div class="mb-6 flex justify-center">
            <form action="{{ route('admin.event.index') }}" method="GET" class="w-full max-w-xl">
                <div class="relative">
                    <input type="text" name="search" placeholder="Search events..."
                        class="w-full px-6 py-3 rounded-full border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        value="{{ request()->search }}">
                    <button type="submit"
                        class="absolute top-0 right-0 px-4 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-500 transition duration-300">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Event Feed -->
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
        </div>
    </div>
</x-app-layout>
