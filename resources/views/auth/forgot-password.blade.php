<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Şifrenizi mi unuttunuz? Sorun değil. Sadece e-posta adresinizi bize bildirin, size yeni bir şifre seçmenizi sağlayacak bir sıfırlama bağlantısı göndereceğiz.') }}
    </div>

    <!-- Oturum Durumu -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- E-posta Adresi -->
        <div>
            <x-input-label for="email" :value="__('E-posta')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Şifre Sıfırlama Bağlantısını Gönder') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
