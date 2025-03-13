<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Merchant') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4 empty-event" style="font-family: 'jakartaSansBold';color: #258D00 !important;">VOLUNTRACK MERCHANDISE</h1>

        {{-- <div class="card mb-4">
            <div class="card-body text-center">
                <h3>Poin MU</h3>
                <h1 class="display-3 text-success">10.000</h1>
            </div>
        </div> --}}

        <div class="row mb-5">
            @if(auth()->user()->canany(['item-create']))
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('merchant.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">Tambah Item</a>
            </div>
            @endif
            @foreach ($items as $item)
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <img src="{{ asset('storage/'.$item->gambar_barang) }}" class="card-img-top"
                        alt="{{ $item->nama_barang }}">
                    <div class="card-body text-center">
                        <h5 class="card-title font-bold">{{ $item->nama_barang }}</h5>
                        <p class="text-gray-600 dark:text-gray-400">Harga: Rp {{ number_format($item->harga_barang, 0,
                            ',',
                            '.') }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Stok: {{ $item->stok }}</p>
                        @if(auth()->user()->canany(['item-show']))
                        <a href="{{ route('merchant.show', $item->id) }}"
                            class=" hover:text-blue-600 no-underline text-white bg-green-600 px-5 py-2 rounded-lg">Beli</a>
                        @endif
                    </div>
                    <div class="mt-4 flex justify-between">

                        @if(auth()->user()->canany(['item-edit']))
                        <a href="{{ route('merchant.edit', $item->id) }}"
                            class=" hover:text-yellow-600 text-white bg-yellow-500 px-5 py-2 rounded-lg no-underline">Edit</a>
                        @endif
                        @if(auth()->user()->canany(['item-delete']))
                        <form action="{{ route('merchant.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" hover:text-red-600 text-white bg-red-500 px-5 py-2 rounded-lg no-underline">Hapus</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



    
</x-app-layout>