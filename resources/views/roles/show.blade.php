<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-100">Show Role</h2>
            <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="fa-solid fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <strong class="block text-gray-400">Name:</strong>
            <p class="text-gray-200">{{ $role->name }}</p>
        </div>
        <div>
            <strong class="block text-gray-400">Permissions:</strong>
            <div class="flex flex-wrap gap-2 mt-2">
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <span class="px-2 py-1 bg-green-600 text-white text-sm rounded">{{ $v->name }}</span>
                    @endforeach
                @else
                    <p class="text-gray-400">No permissions assigned.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
