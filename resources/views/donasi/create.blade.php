<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donasi untuk Event') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12 px-6">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h3 class="text-3xl font-semibold text-gray-800 mb-4">Dukung Event {{ $event->nama }}</h3>

            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Bantu kami untuk mencapai target donasi sebesar <span class="font-semibold text-green-600">{{ "Rp " . number_format($event->target_donasi,2,',','.') }}</span> untuk keberhasilan acara ini.
            </p>

            <form action="#" method="POST" id="donationForm">
                @csrf

                <div class="space-y-4">

                    <input type="hidden" name="event_id" value="{{$event->id_event}}">
                    <input type="hidden" name="donatur" value="{{ auth()->id() }}">
                    <div class="flex justify-between items-center">
                        <label for="donationAmount" class="text-gray-600 dark:text-gray-400 text-lg">Jumlah Donasi:</label>
                        <input type="number" id="donationAmount" name="amount" value="50000" min="10000" step="10000" class="w-full bg-gray-100  border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-blue-500" placeholder="Masukkan jumlah donasi">
                    </div>

                    <div class="flex justify-between items-center">
                        <label for="donationMessage" class="text-gray-600 dark:text-gray-400 text-lg">Pesan (Opsional):</label>
                        <textarea id="donationMessage" name="message" rows="3" class="w-full bg-gray-100 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-blue-500" placeholder="Tulis pesan Anda"></textarea>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button id="donateButton" type="button" class="w-full bg-green-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-500 transition duration-300">
                            Donasi Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-0gSW-NHntrJYbX79"></script> <!-- Ganti dengan client key Midtrans Anda -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const donateButton = document.getElementById('donateButton');
            const donationAmount = document.getElementById('donationAmount');
            const donationMessage = document.getElementById('donationMessage');

            donateButton.addEventListener('click', function () {
                const amount = donationAmount.value;
                const message = donationMessage.value;

                fetch('/create-transaction', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        first_name: "{{ auth()->user()->username }}",
                        last_name: "{{ auth()->user()->username }}",
                        email: "{{ auth()->user()->email }}",
                        phone: "{{ auth()->user()->phone ?? '123450001' }}",
                        amount: amount,
                        message: message,
                        event_id: "{{ $event->id_event }}",
                        donatur : "{{ auth()->user()->id }}"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                alert("Pembayaran berhasil!");
                                window.location.href = '/thank-you'; // Arahkan ke halaman terima kasih atau status pembayaran
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran!");
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal!");
                            },
                            onClose: function() {
                                alert("Pembayaran dibatalkan!");
                            }
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</x-app-layout>
