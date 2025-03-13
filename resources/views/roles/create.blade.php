<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-100">Create New Role</h2>
            <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="fa fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </x-slot>
    
    @if (count($errors) > 0)
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('roles.store') }}" class="bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        <div class="space-y-4">
            <div class="">
                <label for="name" class="block text-sm font-medium text-gray-200">Name</label>
                <input type="text" id="name" name="name" placeholder="Role Name" class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
    
            <div class="">
                <label class="block text-sm font-medium text-gray-200">Permission</label>
                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($permission as $value)
                        <div class="flex items-center">
                            <input type="checkbox" id="permission_{{ $value->id }}" name="permission[{{ $value->id }}]" value="{{ $value->id }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 bg-gray-700">
                            <label for="permission_{{ $value->id }}" class="ml-2 text-sm text-gray-200">{{ $value->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
    
            <div class="text-center">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Submit
                </button>
            </div>
        </div>
    </form>
    
    
    </x-app-layout>
    