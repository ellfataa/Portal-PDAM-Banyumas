<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Kelola Pembayaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-5 rounded-lg bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <div class="overflow-hidden rounded-xl bg-white shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr><th class="px-5 py-3">Pelanggan</th><th class="px-5 py-3">Order ID</th><th class="px-5 py-3">Nominal</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Tindakan</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse ($pembayarans as $pembayaran)
                                <tr>
                                    <td class="px-5 py-4">{{ $pembayaran->user?->name ?? '-' }}<br><span class="text-xs text-gray-500">{{ $pembayaran->user?->email }}</span></td>
                                    <td class="whitespace-nowrap px-5 py-4">{{ $pembayaran->order_id ?? '-' }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                                    <td class="px-5 py-4">{{ ucfirst($pembayaran->status) }} @if ($pembayaran->midtrans_transaction_status_raw)<span class="block text-xs text-gray-500">Midtrans: {{ $pembayaran->midtrans_transaction_status_raw }}</span>@endif</td>
                                    <td class="whitespace-nowrap px-5 py-4">{{ $pembayaran->created_at?->format('d-m-Y H:i') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        @if ($pembayaran->status === 'pending')
                                            <div class="flex gap-2">
                                                <form method="POST" action="{{ route('admin.pembayaran.terima', $pembayaran->id) }}">@csrf<button class="rounded bg-green-700 px-3 py-1.5 text-white hover:bg-green-800" type="submit">Terima</button></form>
                                                <form method="POST" action="{{ route('admin.pembayaran.tolak', $pembayaran->id) }}">@csrf<button class="rounded bg-red-700 px-3 py-1.5 text-white hover:bg-red-800" type="submit">Tolak</button></form>
                                            </div>
                                        @else
                                            <span class="text-gray-500">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-5 py-8 text-center text-gray-500">Belum ada transaksi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
