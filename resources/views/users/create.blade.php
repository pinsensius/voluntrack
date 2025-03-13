<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Create New User') }}
            </h2>
            <a class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-300" href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left"></i> Back to Users List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (count($errors) > 0)
                    <div class="alert alert-danger mb-4 bg-red-600 text-white p-4 rounded-md shadow-md">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="space-y-4">
                        <!-- Name -->
                        <div class="flex flex-col">
                            <label for="name" class="text-gray-200 font-medium">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" class="bg-gray-700 text-white p-3 rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}">
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col">
                            <label for="email" class="text-gray-200 font-medium">Email:</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email" class="bg-gray-700 text-white p-3 rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}">
                        </div>

                        <!-- Password -->
                        <div class="flex flex-col">
                            <label for="password" class="text-gray-200 font-medium">Password:</label>
                            <input type="password" name="password" id="password" placeholder="Enter Password" class="bg-gray-700 text-white p-3 rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Confirm Password -->
                        <div class="flex flex-col">
                            <label for="confirm-password" class="text-gray-200 font-medium">Confirm Password:</label>
                            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" class="bg-gray-700 text-white p-3 rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Roles -->
                        <div class="flex flex-col">
                            <label for="roles" class="text-gray-200 font-medium">Role:</label>
                            <select name="roles[]" id="roles" class="bg-gray-700 text-white p-3 rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" multiple>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors duration-300">
                                <i class="fa-solid fa-floppy-disk"></i> Create User
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
