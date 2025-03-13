document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen pembayaran
    const pay1 = document.querySelector(".pay1");
    const pay2 = document.querySelector(".pay2");
    const pay3 = document.querySelector(".pay3");

    // Ambil elemen daftar metode pembayaran
    const qris = document.querySelector(".qris");
    const ewallet = document.querySelector(".ewallet");
    const bank = document.querySelector(".bank");

    // Fungsi untuk menyembunyikan semua metode pembayaran
    const hideAllPaymentMethods = () => {
        qris.classList.add("d-none");
        ewallet.classList.add("d-none");
        bank.classList.add("d-none");
    };

    // Tambahkan event listener ke setiap pilihan pembayaran
    pay1.addEventListener("click", function () {
        hideAllPaymentMethods(); // Sembunyikan semua metode pembayaran
        qris.classList.remove("d-none"); // Tampilkan metode pembayaran QRIS
    });

    pay2.addEventListener("click", function () {
        hideAllPaymentMethods(); // Sembunyikan semua metode pembayaran
        ewallet.classList.remove("d-none"); // Tampilkan metode pembayaran E-Wallet
    });

    pay3.addEventListener("click", function () {
        hideAllPaymentMethods(); // Sembunyikan semua metode pembayaran
        bank.classList.remove("d-none"); // Tampilkan metode pembayaran Bank
    });
});
