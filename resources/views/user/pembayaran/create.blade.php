<!-- NGGAK DI PAKE -->

{{-- resources/views/user/pembayaran/create.blade.php --}}
<x-app-layout>
    <div class="py-10">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded text-center">
            <h2 class="text-xl font-bold mb-4">Pembayaran Anda</h2>
            <p class="text-gray-600 mb-4">Klik tombol di bawah untuk melanjutkan pembayaran melalui Midtrans.</p>
            <a href="{{ route('pembayaran.snap') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Bayar Sekarang
            </a>
        </div>
    </div>
</x-app-layout>
