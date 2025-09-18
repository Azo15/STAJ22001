<section class="card shadow-sm border-0 rounded-3 p-4 mb-4">
    <header class="mb-3 border-bottom pb-2">
        <h2 class="h5 fw-bold text-danger">
            {{ __('⚠️ Hesabı Sil') }}
        </h2>
        <p class="text-muted small">
            {{ __('Hesabınız silindiğinde, tüm kaynaklar ve veriler kalıcı olarak silinecektir. Hesabınızı silmeden önce saklamak istediğiniz tüm verileri indirmenizi öneririz.') }}
        </p>
    </header>

    <!-- Hesabı Sil Butonu -->
    <div class="mt-3">
        <x-danger-button class="btn btn-danger btn-sm px-3"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Hesabı Sil') }}
        </x-danger-button>
    </div>

    <!-- Silme Onay Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h2 class="h6 fw-bold text-danger mb-2">
                {{ __('Hesabınızı silmek istediğinizden emin misiniz?') }}
            </h2>
            <p class="text-muted small mb-3">
                {{ __('Hesabınız silindiğinde, tüm kaynaklar ve veriler kalıcı olarak silinecektir. Lütfen işlemi onaylamak için şifrenizi girin.') }}
            </p>

            <!-- Şifre Alanı -->
            <div class="mb-3">
                <x-input-label for="password" value="{{ __('Şifre') }}" class="form-label visually-hidden" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control w-75"
                    placeholder="{{ __('Şifre') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="text-danger small mt-1" />
            </div>

            <!-- Butonlar -->
            <div class="d-flex justify-content-end gap-2">
                <x-secondary-button class="btn btn-secondary btn-sm" x-on:click="$dispatch('close')">
                    {{ __('İptal') }}
                </x-secondary-button>

                <x-danger-button class="btn btn-danger btn-sm">
                    {{ __('Hesabı Sil') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
