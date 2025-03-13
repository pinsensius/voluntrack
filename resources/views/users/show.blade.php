<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Show User') }}
            </h2>
            <a class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300" href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left"></i> Back to Users List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="space-y-4">
                    <!-- Name -->
                    <div class="flex flex-col">
                        <label class="text-gray-200 font-medium">Name:</label>
                        <p class="bg-gray-700 text-white p-3 rounded-md">{{ $user->username }}</p>
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col">
                        <label class="text-gray-200 font-medium">Email:</label>
                        <p class="bg-gray-700 text-white p-3 rounded-md">{{ $user->email }}</p>
                    </div>

                    <!-- Roles -->
                    <div class="flex flex-col">
                        <label class="text-gray-200 font-medium">Roles:</label>
                        <div class="flex space-x-2">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">{{ $v }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
