<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="container w-full flex justify-center mx-auto mt-12">
        <form action="{{ route('merchant.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-1/2">
            @csrf

            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-semibold text-gray-700">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" class="mt-2 p-2 w-full rounded-md  border-gray-700" required>
            </div>

            <div class="mb-4">
                <label for="harga_barang" class="block text-sm font-semibold text-gray-700">Harga Barang</label>
                <input type="number" id="harga_barang" name="harga_barang" class="mt-2 p-2 w-full rounded-md  border-gray-700" required>
            </div>

            <div class="mb-4">
                <label for="stok" class="block text-sm font-semibold text-gray-700">Stok</label>
                <input type="number" id="stok" name="stok" class="mt-2 p-2 w-full rounded-md  border-gray-700" required>
            </div>

            <div class="mb-4">
                <label for="gambar_barang" class="block text-sm font-semibold text-gray-700">Gambar Barang</label>
                <input type="file" id="gambar_barang" name="gambar_barang" class="mt-2 p-2 w-full rounded-md  border-gray-700" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600">Simpan</button>
        </form>
    </div>
</x-app-layout>
