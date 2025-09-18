<section class="card shadow-sm border-0 rounded-3 p-4 mb-4">
    <header class="mb-3 border-bottom pb-2">
        <h2 class="h5 fw-bold text-primary">
            {{ __('👤 Profil Bilgileri') }}
        </h2>
        <p class="text-muted small">
            {{ __('Hesabınızın profil bilgilerini ve e-posta adresini güncelleyin.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-3">
        @csrf
        @method('patch')

        <!-- Ad Soyad -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('Ad Soyad')" class="form-label fw-semibold" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="form-control" 
                :value="old('name', $user->name)" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error class="text-danger small mt-1" :messages="$errors->get('name')" />
        </div>

        <!-- E-posta -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('E-posta')" class="form-label fw-semibold" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="form-control" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="text-danger small mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2 p-2 small">
                    <p class="mb-1">
                        {{ __('E-posta adresiniz doğrulanmamış.') }}
                    </p>
                    <button 
                        form="send-verification" 
                        class="btn btn-link p-0 small text-decoration-underline"
                    >
                        {{ __('Doğrulama e-postasını yeniden göndermek için tıklayın.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success mt-2 small fw-semibold">
                            {{ __('Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Kaydet Butonu -->
        <div class="d-flex align-items-center gap-3">
            <x-primary-button class="btn btn-primary px-4">{{ __('💾 Kaydet') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success fw-semibold small mb-0"
                >{{ __('✅ Kaydedildi.') }}</p>
            @endif
        </div>
    </form>
</section>
