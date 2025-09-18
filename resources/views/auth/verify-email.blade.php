<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Kaydolduğunuz için teşekkürler! Başlamadan önce, lütfen e-posta adresinizi doğrulamak için size gönderdiğimiz bağlantıya tıklayın. E-postayı almadıysanız, size memnuniyetle yeniden göndeririz.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Kayıt sırasında verdiğiniz e-posta adresine yeni bir doğrulama bağlantısı gönderildi.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Doğrulama E-postasını Yeniden Gönder') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Çıkış Yap') }}
            </button>
        </form>
    </div>
</x-guest-layout>
