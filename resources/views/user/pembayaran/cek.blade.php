<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Status Pembayaran</h2>
    </x-slot>

    @php
        $noticeColors = [
            'success' => 'border-green-200 bg-green-50 text-green-800',
            'error' => 'border-red-200 bg-red-50 text-red-800',
            'warning' => 'border-yellow-200 bg-yellow-50 text-yellow-800',
            'info' => 'border-blue-200 bg-blue-50 text-blue-800',
        ];
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if ($message)
                <div class="rounded-xl border p-5 {{ $noticeColors[$messageType] ?? $noticeColors['info'] }}">{{ $message }}</div>
            @endif

            @if ($payment)
                <div class="rounded-xl bg-white p-6 shadow">
                    <dl class="grid gap-4 sm:grid-cols-2">
                        <div><dt class="text-sm text-gray-500">Order ID</dt><dd class="mt-1 font-semibold">{{ $payment->order_id }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Status</dt><dd class="mt-1 font-semibold">{{ $displayStatus ?? ucfirst($payment->status) }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Nominal</dt><dd class="mt-1 font-semibold">Rp {{ number_format($payment->nominal, 0, ',', '.') }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Tanggal</dt><dd class="mt-1">{{ $payment->created_at?->format('d-m-Y H:i') }}</dd></div>
                        @if ($payment->payment_type)
                            <div><dt class="text-sm text-gray-500">Metode pembayaran</dt><dd class="mt-1">{{ str_replace('_', ' ', ucfirst($payment->payment_type)) }}</dd></div>
                        @endif
                    </dl>
                    <div class="mt-6 flex flex-wrap gap-3">
                        @if ($actionButton === 'Lanjutkan Pembayaran')
                            <a href="{{ route('pembayaran.snap', ['order_id' => $payment->order_id]) }}" class="rounded-lg bg-orange-600 px-4 py-2 font-semibold text-white hover:bg-orange-700">Lanjutkan pembayaran</a>
                        @endif
                        <a href="{{ route('pembayaran.riwayat') }}" class="rounded-lg border border-gray-300 px-4 py-2 font-medium text-gray-700 hover:bg-gray-50">Riwayat pembayaran</a>
                    </div>
                </div>
            @else
                <div class="rounded-xl bg-white p-6 shadow">
                    <a href="{{ route('user.home') }}" class="font-medium text-blue-700 hover:underline">Kembali ke beranda</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
