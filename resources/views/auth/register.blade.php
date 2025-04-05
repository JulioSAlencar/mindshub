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
                    <p>**TERMO DE USO DA PLATAFORMA GAMIFICADA MIDSHUB**

                        **1. ACEITAÇÃO DOS TERMOS**
                        Ao acessar e utilizar a Midshub, você concorda em cumprir os termos e condições aqui estabelecidos. Caso não concorde, por favor, não utilize a plataforma.

                        **2. DESCRIÇÃO DO SERVIÇO**
                        A Midshub é um ambiente gamificado que oferece desafios, recompensas, rankings e outras funcionalidades. O objetivo é proporcionar uma experiência interativa para os usuários, respeitando as diretrizes estabelecidas.

                        **3. CADASTRO E CONTA**
                        - O usuário deve fornecer informações precisas e atualizadas ao se cadastrar.
                        - O uso da conta é pessoal e intransferível.
                        - A plataforma se reserva o direito de suspender ou excluir contas que violem os termos de uso.

                        **4. REGRAS DE CONDUTA**
                        - Respeitar os demais usuários e a equipe da plataforma.
                        - Não utilizar a plataforma para atividades ilegais ou que infrinjam direitos de terceiros.
                        - Não tentar manipular rankings, pontos ou recompensas de forma fraudulenta.

                        **5. RECOMPENSAS E PONTUAÇÃO**
                        - O sistema de pontuação e recompensas está sujeito a alterações a critério da plataforma.
                        - Recompensas são intransferíveis e podem estar sujeitas a regras específicas.

                        **6. PRIVACIDADE E SEGURANÇA**
                        - Os dados fornecidos pelo usuário serão tratados conforme a nossa [Política de Privacidade].
                        - A plataforma adota medidas de segurança para proteger as informações dos usuários, mas não se responsabiliza por acessos indevidos causados por negligência do usuário.

                        **7. RESPONSABILIDADE DA PLATAFORMA**
                        - A plataforma não garante que o serviço estará disponível ininterruptamente.
                        - A plataforma não se responsabiliza por prejuízos decorrentes do uso inadequado dos serviços.

                        **8. ALTERAÇÕES NO TERMO DE USO**
                        Este termo pode ser atualizado a qualquer momento. Notificações serão enviadas em caso de mudanças significativas.

                        **9. CONTATO**
                        Em caso de dúvidas ou sugestões, entre em contato pelo e-mail: [E-mail de Suporte].

                        Ao utilizar a Midshub, você confirma que leu e concorda com estes termos.

                    </p>
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
