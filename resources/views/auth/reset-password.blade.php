<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Şifre Sıfırlama Jetonu -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- E-posta Adresi -->
        <div>
            <x-input-label for="email" :value="__('E-posta')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Şifre -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Şifre')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Şifreyi Onayla -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Şifreyi Onayla')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Şifreyi Sıfırla') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
