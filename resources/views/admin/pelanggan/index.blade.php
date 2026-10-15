<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Kelola Pelanggan</h2>
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
                            <tr><th class="px-5 py-3">Pelanggan</th><th class="px-5 py-3">Lokasi</th><th class="px-5 py-3">Dokumen</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse ($pendaftarans as $pendaftaran)
                                <tr>
                                    <td class="px-5 py-4">{{ $pendaftaran->nama_lengkap }}<br><span class="text-xs text-gray-500">{{ $pendaftaran->user?->email }} · {{ $pendaftaran->pekerjaan }}</span></td>
                                    <td class="px-5 py-4">{{ $pendaftaran->kelurahan?->nama ?? '-' }}, {{ $pendaftaran->kecamatan?->nama ?? '-' }}<br><span class="text-xs text-gray-500">{{ $pendaftaran->latitude }}, {{ $pendaftaran->longitude }}</span></td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        @if ($pendaftaran->foto_rumah)<a class="text-blue-700 hover:underline" target="_blank" rel="noopener" href="{{ asset('storage/'.$pendaftaran->foto_rumah) }}">Foto rumah</a>@endif
                                        @if ($pendaftaran->foto_ktp)<a class="ml-2 text-blue-700 hover:underline" target="_blank" rel="noopener" href="{{ asset('storage/'.$pendaftaran->foto_ktp) }}">KTP</a>@endif
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">{{ $pendaftaran->created_at?->format('d-m-Y') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="flex gap-3">
                                            <a class="font-medium text-blue-700 hover:underline" href="{{ route('admin.pelanggan.edit', $pendaftaran->id) }}">Edit</a>
                                            <form method="POST" action="{{ route('admin.pelanggan.destroy', $pendaftaran->id) }}" onsubmit="return confirm('Hapus data pendaftaran pelanggan ini?')">@csrf @method('DELETE')<button class="font-medium text-red-700 hover:underline" type="submit">Hapus</button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-5 py-8 text-center text-gray-500">Belum ada pendaftaran pelanggan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
