<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-100">Role Management</h2>
            @can('role-create')
                <a href="{{ route('roles.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <i class="fa fa-plus mr-1"></i> Create New Role
                </a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-600 text-white p-4 rounded mb-4" role="alert"> 
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-gray-800 p-6 rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-700 text-gray-200">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($roles as $key => $role)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ ++$i }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $role->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('roles.show',$role->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <i class="fa-solid fa-list mr-1"></i> Show
                        </a>
                        @can('role-edit')
                            <a href="{{ route('roles.edit',$role->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </a>
                        @endcan

                        @can('role-delete')
                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    <i class="fa-solid fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {!! $roles->links('pagination::tailwind') !!}
    </div>
</x-app-layout>
