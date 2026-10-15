<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Laporan Keuangan</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-xl bg-white shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr><th class="px-5 py-3">Periode</th><th class="px-5 py-3 text-right">Total pembayaran diterima</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($monthlyRevenue as $revenue)
                                <tr><td class="px-5 py-4">{{ \Carbon\Carbon::create((int) $revenue->year, (int) $revenue->month, 1)->translatedFormat('F Y') }}</td><td class="px-5 py-4 text-right font-semibold">Rp {{ number_format($revenue->total_nominal, 0, ',', '.') }}</td></tr>
                            @empty
                                <tr><td colspan="2" class="px-5 py-8 text-center text-gray-500">Belum ada pembayaran yang diterima.</td></tr>
                            @endforelse
                        </tbody>
                        @if ($monthlyRevenue->isNotEmpty())
                            <tfoot class="bg-gray-50"><tr><th class="px-5 py-4 text-left">Total</th><th class="px-5 py-4 text-right">Rp {{ number_format($monthlyRevenue->sum('total_nominal'), 0, ',', '.') }}</th></tr></tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
