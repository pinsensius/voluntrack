<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="flex items-center mb-4">
            <img class="w-32 h-32 object-cover rounded-md" src="{{ asset('storage/'.$item->gambar_barang) }}"
                alt="{{ $item->nama_barang }}">
            <div class="ml-4">
                <h3 class="text-xl font-semibold text-gray-800 ">{{ $item->nama_barang }}</h3>
                <p class="text-gray-600 dark:text-gray-800">Harga: Rp {{ $item->harga_barang}}</p>
                <p class="text-gray-600 dark:text-gray-700">Stok: {{ $item->stok }}</p>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('merchant.index') }}"
                class="bg-gray-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-gray-600">Kembali</a>
            <button id="pay-button"
                class="ml-4 bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600">Beli
                Sekarang</button>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            fetch('{{ route('payment.create') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    item_id: {{ $item-> id }},
            harga_barang: {{ $item-> harga_barang }},
            nama_barang: "{{ $item->nama_barang }}", // Kirim nama produk
            stok: {{ $item-> stok }} // Send stock info if needed
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            alert("Payment successful!");
                            console.log(result);
                        },
                        onPending: function (result) {
                            alert("Payment is pending...");
                            console.log(result);
                        },
                        onError: function (result) {
                            alert("Payment failed.");
                            console.log(result);
                        }
                    });
                } else {
                    alert(data.error || 'Something went wrong');
                }
            })
            .catch(error => {
                alert('There was an error processing your request.');
                console.error(error);
            });
        });
    </script>
</x-app-layout>