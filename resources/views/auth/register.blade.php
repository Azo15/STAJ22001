<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Ad -->
        <div>
            <x-input-label for="name" :value="__('Ad')" />
<<<<<<< HEAD
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
=======
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
>>>>>>> a2844256a63008e24f78a8283ac0af7b5a060774
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- E-posta Adresi -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-posta')" />
<<<<<<< HEAD
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
=======
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
>>>>>>> a2844256a63008e24f78a8283ac0af7b5a060774
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Şifre -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Şifre')" />

<<<<<<< HEAD
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
=======
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
>>>>>>> a2844256a63008e24f78a8283ac0af7b5a060774

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Şifreyi Onayla -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Şifreyi Onayla')" />

<<<<<<< HEAD
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
=======
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
>>>>>>> a2844256a63008e24f78a8283ac0af7b5a060774

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
<<<<<<< HEAD
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
=======
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
>>>>>>> a2844256a63008e24f78a8283ac0af7b5a060774
                {{ __('Zaten kayıtlı mısınız?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Kayıt Ol') }}
            </x-primary-button>
        </div>
    </form>
<<<<<<< HEAD
</x-guest-layout>
=======
</x-guest-layout>
>>>>>>> a2844256a63008e24f78a8283ac0af7b5a060774
