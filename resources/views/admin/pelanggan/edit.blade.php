<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Data Pelanggan</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow sm:p-8">
                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.pelanggan.update', $pendaftaran->id) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div><label for="nama_lengkap" class="mb-1 block text-sm font-medium">Nama lengkap</label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" required class="w-full rounded-lg border-gray-300"></div>
                        <div><label for="email" class="mb-1 block text-sm font-medium">Email akun</label><input id="email" name="email" type="email" value="{{ old('email', $pendaftaran->user?->email) }}" required class="w-full rounded-lg border-gray-300"></div>
                        <div><label for="password" class="mb-1 block text-sm font-medium">Password baru (opsional)</label><input id="password" name="password" type="password" autocomplete="new-password" class="w-full rounded-lg border-gray-300"></div>
                        <div><label for="password_confirmation" class="mb-1 block text-sm font-medium">Konfirmasi password baru</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="w-full rounded-lg border-gray-300"></div>
                        <div><label for="pekerjaan" class="mb-1 block text-sm font-medium">Pekerjaan</label><input id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $pendaftaran->pekerjaan) }}" class="w-full rounded-lg border-gray-300"></div>
                        <div>
                            <label for="kecamatan_id" class="mb-1 block text-sm font-medium">Kecamatan</label>
                            <select id="kecamatan_id" name="kecamatan_id" class="w-full rounded-lg border-gray-300">
                                <option value="">Pilih kecamatan</option>
                                @foreach ($kecamatans as $kecamatan)<option value="{{ $kecamatan->id }}" @selected(old('kecamatan_id', $pendaftaran->kecamatan_id) == $kecamatan->id)>{{ $kecamatan->nama }}</option>@endforeach
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan_id" class="mb-1 block text-sm font-medium">Kelurahan</label>
                            <select id="kelurahan_id" name="kelurahan_id" class="w-full rounded-lg border-gray-300" data-selected="{{ old('kelurahan_id', $pendaftaran->kelurahan_id) }}">
                                <option value="">Pilih kelurahan</option>
                                @foreach ($kelurahans as $kelurahan)<option value="{{ $kelurahan->id }}" @selected(old('kelurahan_id', $pendaftaran->kelurahan_id) == $kelurahan->id)>{{ $kelurahan->nama }}</option>@endforeach
                            </select>
                        </div>
                        <div><label for="latitude" class="mb-1 block text-sm font-medium">Latitude</label><input id="latitude" name="latitude" type="number" step="any" value="{{ old('latitude', $pendaftaran->latitude) }}" class="w-full rounded-lg border-gray-300"></div>
                        <div><label for="longitude" class="mb-1 block text-sm font-medium">Longitude</label><input id="longitude" name="longitude" type="number" step="any" value="{{ old('longitude', $pendaftaran->longitude) }}" class="w-full rounded-lg border-gray-300"></div>
                        <div><label for="foto_rumah" class="mb-1 block text-sm font-medium">Ganti foto rumah</label><input id="foto_rumah" name="foto_rumah" type="file" accept=".jpg,.jpeg,.png" class="w-full rounded-lg border border-gray-300 p-2"></div>
                        <div><label for="foto_ktp" class="mb-1 block text-sm font-medium">Ganti foto KTP</label><input id="foto_ktp" name="foto_ktp" type="file" accept=".jpg,.jpeg,.png" class="w-full rounded-lg border border-gray-300 p-2"></div>
                    </div>
                    <div class="flex gap-3 pt-2"><button class="rounded-lg bg-blue-700 px-5 py-2.5 font-semibold text-white hover:bg-blue-800" type="submit">Simpan perubahan</button><a href="{{ route('admin.pelanggan.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 font-medium text-gray-700">Batal</a></div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const kecamatanSelect = document.getElementById('kecamatan_id');
        const kelurahanSelect = document.getElementById('kelurahan_id');
        kecamatanSelect.addEventListener('change', async () => {
            kelurahanSelect.innerHTML = '<option value="">Memuat kelurahan...</option>';
            if (!kecamatanSelect.value) {
                kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan</option>';
                return;
            }

            try {
                const response = await fetch(`/get-kelurahan/${encodeURIComponent(kecamatanSelect.value)}`, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    throw new Error('Daftar kelurahan gagal dimuat.');
                }
                const kelurahans = await response.json();
                kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan</option>';
                kelurahans.forEach((kelurahan) => {
                    const option = document.createElement('option');
                    option.value = kelurahan.id;
                    option.textContent = kelurahan.nama;
                    kelurahanSelect.appendChild(option);
                });
            } catch (error) {
                kelurahanSelect.innerHTML = '<option value="">Gagal memuat kelurahan</option>';
                console.error(error);
            }
        });
    </script>
</x-app-layout>
