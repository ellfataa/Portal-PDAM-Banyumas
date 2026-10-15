<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran PDAM Banyumas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <main class="mx-auto flex min-h-screen max-w-2xl items-center justify-center px-4 py-10">
        <section class="w-full rounded-xl bg-white p-8 text-center shadow">
            <h1 class="text-2xl font-bold text-blue-800">Selesaikan Pembayaran</h1>
            <p class="mt-3 text-gray-600">Klik tombol di bawah untuk memilih metode pembayaran yang tersedia.</p>
            @if (session('error'))
                <p class="mt-4 rounded-lg bg-red-50 p-3 text-red-700">{{ session('error') }}</p>
            @endif
            <button id="pay-button" type="button" class="mt-6 rounded-lg bg-orange-600 px-6 py-3 font-semibold text-white hover:bg-orange-700">Bayar sekarang</button>
            <div class="mt-4"><a href="{{ route('pembayaran.cek') }}" class="text-sm font-medium text-blue-700 hover:underline">Kembali ke status pembayaran</a></div>
        </section>
    </main>
    <script>
        document.getElementById('pay-button').addEventListener('click', () => {
            window.snap.pay(@json($snapToken), {
                onSuccess: () => window.location.assign(@json(route('pembayaran.cek'))),
                onPending: () => window.location.assign(@json(route('pembayaran.cek'))),
                onError: () => window.location.assign(@json(route('pembayaran.cek'))),
                onClose: () => window.location.assign(@json(route('pembayaran.cek')))
            });
        });
    </script>
</body>
</html>
