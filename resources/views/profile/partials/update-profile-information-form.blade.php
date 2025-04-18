<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_photo" :value="__('Foto de Perfil')" />
            <input
                id="profile_photo"
                name="profile_photo"
                type="file"
                accept="image/*"
                class="mt-1 block w-full"
                onchange="previewImage(event)"
            />
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        
            <!-- Preview da imagem -->
            <div class="mt-4">
                <img
                    id="photo-preview"
                    alt="Foto de perfil"
                    class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm"
                    style="width: 300px; height: 200px; display: none;"
                >
            </div>   
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- Script para pré-visualizar a imagem -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('photo-preview');
            const file = event.target.files[0];

            // Verifica se o usuário selecionou um arquivo
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Exibe a imagem
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
</section>
