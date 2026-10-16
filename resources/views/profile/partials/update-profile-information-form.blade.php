<section>
    <header class="mb-6">
        <h2 class="text-2xl font-extrabold text-[#1746A2] mb-2">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500 font-medium">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm text-gray-700 font-semibold mb-1">{{ __('Nama Lengkap') }}</label>
            <input id="name" name="name" type="text"
                   class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-2 text-red-500 text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm text-gray-700 font-semibold mb-1">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                   class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300"
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="mt-2 text-red-500 text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-[#FF731D] hover:bg-[#e06518] text-white font-bold px-8 py-3 rounded-xl shadow-md shadow-orange-200 transition duration-300 transform hover:-translate-y-0.5">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="text-sm font-semibold text-green-600 bg-green-50 px-4 py-2 rounded-lg">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
