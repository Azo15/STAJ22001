<section class="card shadow-sm border-0 rounded-3 p-4 mb-4">
    <header class="mb-3 border-bottom pb-2">
        <h2 class="h5 fw-bold text-primary">
            {{ __('🔒 Şifreyi Güncelle') }}
        </h2>
        <p class="text-muted small">
            {{ __('Hesabınızın güvenliği için uzun ve rastgele bir şifre kullanmanız önerilir.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-3">
        @csrf
        @method('put')

        <!-- Mevcut Şifre -->
        <div class="mb-3">
            <x-input-label for="update_password_current_password" :value="__('Mevcut Şifre')" class="form-label fw-semibold" />
            <x-text-input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="form-control" 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-danger small mt-1" />
        </div>

        <!-- Yeni Şifre -->
        <div class="mb-3">
            <x-input-label for="update_password_password" :value="__('Yeni Şifre')" class="form-label fw-semibold" />
            <x-text-input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="form-control" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="text-danger small mt-1" />
        </div>

        <!-- Yeni Şifre (Tekrar) -->
        <div class="mb-3">
            <x-input-label for="update_password_password_confirmation" :value="__('Yeni Şifre (Tekrar)')" class="form-label fw-semibold" />
            <x-text-input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-control" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-danger small mt-1" />
        </div>

        <!-- Kaydet Butonu -->
        <div class="d-flex align-items-center gap-3">
            <x-primary-button class="btn btn-primary px-4">{{ __('💾 Kaydet') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success fw-semibold small mb-0"
                >
                    {{ __('✅ Kaydedildi.') }}
                </p>
            @endif
        </div>
    </form>
</section>
