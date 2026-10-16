<section>
    <header class="mb-6">
        <h2 class="text-2xl font-extrabold text-[#1746A2] mb-2">
            {{ __('Perbarui Password') }}
        </h2>
        <p class="text-sm text-gray-500 font-medium">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm text-gray-700 font-semibold mb-1">{{ __('Password Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300"
                autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-red-500 text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm text-gray-700 font-semibold mb-1">{{ __('Password Baru') }}</label>
            <input id="update_password_password" name="password" type="password"
                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300"
                autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="mt-1 text-red-500 text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm text-gray-700 font-semibold mb-1">{{ __('Konfirmasi Password Baru') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300"
                autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-red-500 text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 mt-8 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-[#1746A2] hover:bg-[#103070] text-white font-bold py-2.5 px-8 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-0.5">
                {{ __('Simpan Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="text-sm text-green-600 font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
