<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Users Management') }}
            </h2>
            <a class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-300" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Create New User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="alert alert-success mb-4 bg-green-600 text-white p-4 rounded-md shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table-auto w-full text-gray-200">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Roles</th>
                            <th class="px-4 py-2" width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr class="bg-gray-900 border-b border-gray-700">
                                <td class="px-4 py-2">{{ ++$i }}</td>
                                <td class="px-4 py-2">{{ $user->username }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <span class="inline-block bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">
                                                {{ $v }}
                                            </span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="px-4 py-2 flex space-x-2">
                                    @if(auth()->user()->canany(['user-show']))
                                    <a class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300" href="{{ route('users.show', $user->id) }}">
                                        <i class="fa-solid fa-list"></i> Show
                                    </a>
                                    @endif
                                    @if(auth()->user()->canany(['user-edit']))
                                    <a class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition-colors duration-300" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    @endif
                                    @if(auth()->user()->canany(['user-delete']))
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-300">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {!! $data->links('pagination::tailwind') !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
