<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Kelola Pelanggan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #e2e6ea;
        }
        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-[#FFFFFF] text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">

        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3 sm:space-x-4 mb-2 md:mb-0">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-25 sm:h-12 sm:w-27">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                        <p class="text-sm text-gray-600 font-medium">Panel Administrator</p>
                    </div>
                </div>

                <nav class="w-full md:w-auto flex justify-center md:justify-end items-center space-x-4 sm:space-x-6 text-base font-medium relative">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-[#1746A2] focus:outline-none focus:ring-2 focus:ring-[#5F9DF7] focus:ring-opacity-50 px-3 py-2 rounded-lg transition duration-300 ease-in-out">
                            Halo, {{ Auth::user()->name }}
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main -->
        <main class="flex-grow py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Tombol Kembali -->
                <div class="mb-4 text-start w-full">
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#1746A2] transition duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1746A2] mb-4">Kelola Pelanggan</h2>
                    <p class="text-gray-700 text-lg max-w-2xl mx-auto">
                        Di sini Anda dapat melihat data pendaftaran pelanggan PDAM Banyumas.
                    </p>
                </div>

                <!-- Notifikasi Status -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif


                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-[#1746A2] to-[#5F9DF7]">
                        <h3 class="text-xl font-bold text-white">Daftar Pendaftaran Pelanggan</h3>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        @if ($pendaftarans->isEmpty())
                            <p class="text-center text-gray-500 py-8">Tidak ada data pendaftaran pelanggan yang ditemukan.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 table-auto table-striped table-hover">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Lengkap
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email User
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pekerjaan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kecamatan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kelurahan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Terdaftar Sejak
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($pendaftarans as $pendaftaran)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $pendaftaran->nama_lengkap }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pendaftaran->user->email ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pendaftaran->pekerjaan ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pendaftaran->kecamatan->nama ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pendaftaran->kelurahan->nama ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pendaftaran->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button
                                                    type="button"
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $pendaftaran->id }}')"
                                                    class="text-red-600 hover:text-red-900 focus:outline-none"
                                                >
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Panel Administrator - Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <!-- Modals untuk konfirmasi penghapusan -->
    {{-- Menggunakan $pendaftarans untuk loop modal --}}
    @foreach ($pendaftarans as $pendaftaran)
        <div x-data="{ show: false }" x-show="show" x-on:open-modal.window="show = ($event.detail === 'confirm-user-deletion-{{ $pendaftaran->id }}')" x-on:close-modal.window="show = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Konfirmasi Hapus Pendaftaran Pelanggan
                </h3>
                <p class="text-sm text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus pendaftaran pelanggan atas nama <strong>{{ $pendaftaran->nama_lengkap }}</strong>? Semua data terkait pendaftaran ini (termasuk pembayaran spesifik pendaftaran ini) akan dihapus secara permanen.
                </p>
                <div class="mt-6 flex justify-end">
                    <button type="button" x-on:click="show = false" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('admin.pelanggan.destroy', $pendaftaran->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</body>
</html>
