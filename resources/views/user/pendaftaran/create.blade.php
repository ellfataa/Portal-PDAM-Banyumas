<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Form Pendaftaran Pelanggan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body class="bg-[#FFFFFF] text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3 sm:space-x-4 mb-2 md:mb-0">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-25 sm:h-12 sm:w-27">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <nav class="w-full md:w-auto flex justify-center md:justify-end items-center space-x-4 sm:space-x-6 text-base font-medium relative">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-[#1746A2] focus:outline-none focus:ring-2 focus:ring-[#5F9DF7] focus:ring-opacity-50 px-3 py-2 rounded-lg transition duration-300 ease-in-out">
                            Halo, {{ Auth::user()->name }}
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
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
                <div class="mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#1746A2]">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Pendaftaran Pelanggan</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-[#1746A2] mb-4">Form Pendaftaran Pelanggan</h2>
                    <p class="text-gray-700 text-lg">Silakan lengkapi formulir berikut untuk mendaftar sebagai pelanggan PDAM Banyumas</p>
                </div>

                <!-- Form Pendaftaran -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 mb-2">
                    <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-xl font-bold text-[#1746A2] mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Informasi Pribadi
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Lengkap -->
                                <div>
                                    <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <input id="nama_lengkap" name="nama_lengkap" type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out" 
                                           value="{{ old('nama_lengkap') }}" required>
                                    @error('nama_lengkap')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pekerjaan -->
                                <div>
                                    <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan</label>
                                    <input id="pekerjaan" name="pekerjaan" type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out" 
                                           value="{{ old('pekerjaan') }}" required>
                                    @error('pekerjaan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Location Information Section -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-xl font-bold text-[#1746A2] mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Informasi Lokasi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Kecamatan -->
                                <div>
                                    <label for="kecamatan" class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan</label>
                                    <select name="kecamatan_id" id="kecamatan" required 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($kecamatans as $kecamatan)
                                            <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                                {{ $kecamatan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kelurahan -->
                                <div>
                                    <label for="kelurahan" class="block text-sm font-semibold text-gray-700 mb-2">Kelurahan</label>
                                    <select name="kelurahan_id" id="kelurahan" required 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    @error('kelurahan_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Map Section -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Lokasi Rumah</label>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <button type="button" onclick="setKeLokasiPDAM()" 
                                            class="flex items-center px-4 py-2 bg-[#5F9DF7] text-white rounded-xl hover:bg-opacity-80 transition duration-300 ease-in-out font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Lokasi Kantor PDAM
                                    </button>
                                    <button type="button" onclick="gunakanLokasiSaya()" 
                                            class="flex items-center px-4 py-2 bg-[#FF731D] text-white rounded-xl hover:bg-opacity-80 transition duration-300 ease-in-out font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Gunakan Lokasi Saya
                                    </button>
                                </div>
                                <div id="map" class="w-full h-80 rounded-xl border border-gray-300 shadow-sm"></div>
                                <p class="text-sm text-gray-600 mt-2">Klik pada peta untuk menentukan lokasi rumah Anda</p>
                            </div>

                            <!-- Koordinat -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-2">Latitude</label>
                                    <input id="latitude" name="latitude" type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out" 
                                           value="{{ old('latitude') }}" required readonly>
                                    @error('latitude')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-2">Longitude</label>
                                    <input id="longitude" name="longitude" type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out" 
                                           value="{{ old('longitude') }}" required readonly>
                                    @error('longitude')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Document Upload Section -->
                        <div class="pb-6">
                            <h3 class="text-xl font-bold text-[#1746A2] mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Upload Dokumen
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Foto Rumah -->
                                <div>
                                    <label for="foto_rumah" class="block text-sm font-semibold text-gray-700 mb-2">Foto Rumah</label>
                                    <div class="relative">
                                        <input type="file" name="foto_rumah" accept="image/*" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#5F9DF7] file:text-white hover:file:bg-opacity-80" 
                                               required>
                                    </div>
                                    @error('foto_rumah')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG (Max: 2MB)</p>
                                </div>

                                <!-- Foto KTP -->
                                <div>
                                    <label for="foto_ktp" class="block text-sm font-semibold text-gray-700 mb-2">Foto KTP</label>
                                    <div class="relative">
                                        <input type="file" name="foto_ktp" accept="image/*" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#5F9DF7] focus:border-transparent transition duration-200 ease-in-out file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#5F9DF7] file:text-white hover:file:bg-opacity-80" 
                                               required>
                                    </div>
                                    @error('foto_ktp')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG (Max: 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center pt-6">
                            <button type="submit" 
                                    class="flex items-center justify-center px-8 py-3 bg-[#1746A2] text-white font-semibold rounded-xl shadow-md hover:bg-opacity-90 transition duration-300 ease-in-out transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Daftar Sebagai Pelanggan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        kecamatanSelect.addEventListener('change', function () {
            kelurahanSelect.innerHTML = '<option>Memuat...</option>';
            fetch(`/get-kelurahan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    data.forEach(kel => {
                        kelurahanSelect.innerHTML += `<option value="${kel.id}">${kel.nama}</option>`;
                    });
                })
                .catch(() => kelurahanSelect.innerHTML = '<option>Gagal memuat</option>');
        });

        const pdamLat = -7.416823;
        const pdamLng = 109.248238;
        const map = L.map('map').setView([pdamLat, pdamLng], 13);
        let marker = null;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        function updateMarker(lat, lng) {
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            updateMarker(lat.toFixed(6), lng.toFixed(6));
        });

        function setKeLokasiPDAM() {
            updateMarker(pdamLat, pdamLng);
            map.setView([pdamLat, pdamLng], 16);
        }

        function gunakanLokasiSaya() {
            if (!navigator.geolocation) {
                alert("Browser Anda tidak mendukung geolokasi.");
                return;
            }

            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude.toFixed(6);
                const lng = position.coords.longitude.toFixed(6);
                updateMarker(lat, lng);
                map.setView([lat, lng], 16);
            }, function () {
                alert("Gagal mendapatkan lokasi. Pastikan izin lokasi aktif.");
            });
        }

        // Inisialisasi marker jika ada nilai lama
        window.onload = () => {
            const lat = parseFloat(document.getElementById('latitude').value);
            const lng = parseFloat(document.getElementById('longitude').value);
            if (lat && lng) {
                updateMarker(lat, lng);
                map.setView([lat, lng], 15);
            }
        };
    </script>
</body>
</html>