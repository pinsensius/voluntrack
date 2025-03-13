<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-100">Edit Role</h2>
            <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="fa fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </x-slot>

    @if (count($errors) > 0)
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.update', $role->id) }}" class="bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" value="{{ $role->name }}" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-200 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="permissions" class="block text-sm font-medium text-gray-300">Permission:</label>
            <div id="permissions" class="grid grid-cols-2 gap-4">
                @foreach($permission as $value)
                    <div>
                        <label class="inline-flex items-center text-sm text-gray-200">
                            <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="form-checkbox rounded border-gray-600 text-blue-500 focus:ring-blue-400" {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                            <span class="ml-2">{{ $value->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="fa-solid fa-floppy-disk mr-1"></i> Submit
            </button>
        </div>
    </form>
</x-app-layout>
