<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <!-- Nome -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Endereço de E-mail -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Checkbox de Termos de Uso -->
        <div class="mt-4 flex items-center">
            <x-checkbox id="terms" name="terms" required />
            <label for="terms" class="ml-2 text-sm text-gray-700">
                Concordo com os
                <a href="#" onclick="document.getElementById('terms-modal').showModal()" class="text-blue-600 hover:text-blue-800">
                    Termos de Uso
                </a>
            </label>
        </div>
        <x-input-error :messages="$errors->get('terms')" class="mt-2" />

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <dialog id="terms-modal" class="backdrop:bg-gray-800 backdrop:opacity-90 bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl">
            <div class="max-h-[70vh] overflow-y-auto">
                <h3 class="text-lg font-bold mb-4">Termos de Uso</h3>

                <div class="space-y-4">
                    <p>Para poder usar esse site você tera que rebola de ladinho para os crias!</p>
                </div>

                <div class="mt-6 flex justify-end">
                    <button onclick="document.getElementById('terms-modal').close()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Fechar
                    </button>
                </div>
            </div>
        </dialog>
    </form>
</x-guest-layout>
