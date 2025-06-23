<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Laporan Keuangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
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

                <!-- Admin Info & Logout (Dropdown Menu) -->
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
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1746A2] mb-4">Laporan Keuangan</h2>
                    <p class="text-gray-700 text-lg max-w-2xl mx-auto">
                        Di sini Anda dapat melihat berbagai laporan terkait data keuangan dan pembayaran.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-[#1746A2] to-[#5F9DF7]">
                        <h3 class="text-xl font-bold text-white">Pendapatan Bulanan</h3>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        @if ($monthlyRevenue->isEmpty())
                            <p class="text-center text-gray-500 py-8">Tidak ada data pendapatan yang ditemukan.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 table-auto table-striped table-hover">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tahun
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bulan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Nominal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($monthlyRevenue as $data)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $data->year }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::createFromDate($data->year, $data->month, 1)->translatedFormat('F') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900">
                                                Rp {{ number_format($data->total_nominal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Anda bisa menambahkan Chart.js di sini untuk visualisasi grafik --}}
                            {{-- <div class="mt-8 chart-container">
                                <canvas id="monthlyRevenueChart"></canvas>
                            </div> --}}
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
    {{-- Script untuk Chart.js (jika ingin menambahkan grafik) --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('monthlyRevenueChart');
            if (ctx) {
                const monthlyRevenueData = @json($monthlyRevenue);
                const labels = monthlyRevenueData.map(item => {
                    const date = new Date(item.year, item.month - 1);
                    return date.toLocaleString('id-ID', { month: 'long', year: 'numeric' });
                });
                const data = monthlyRevenueData.map(item => item.total_nominal);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Pendapatan (Rp)',
                            data: data,
                            backgroundColor: 'rgba(95, 157, 247, 0.7)',
                            borderColor: '#5F9DF7',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value, index, values) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script> --}}
</body>
</html>
