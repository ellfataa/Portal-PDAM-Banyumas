<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Riwayat Pembayaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-xl bg-white shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Order ID</th><th class="px-5 py-3">Nominal</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse ($riwayats as $riwayat)
                                <tr>
                                    <td class="whitespace-nowrap px-5 py-4">{{ $riwayat->created_at?->format('d-m-Y H:i') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 font-medium">{{ $riwayat->order_id ?? '-' }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">Rp {{ number_format($riwayat->nominal, 0, ',', '.') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">{{ ucfirst($riwayat->status) }}</td>
                                    <td class="whitespace-nowrap px-5 py-4"><a class="font-medium text-blue-700 hover:underline" href="{{ route('pembayaran.cek', ['order_id' => $riwayat->order_id]) }}">Lihat status</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-5 py-8 text-center text-gray-500">Belum ada riwayat pembayaran.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-gray-100 p-5"><a href="{{ route('user.home') }}" class="font-medium text-blue-700 hover:underline">Kembali ke beranda</a></div>
            </div>
        </div>
    </div>
</x-app-layout>
