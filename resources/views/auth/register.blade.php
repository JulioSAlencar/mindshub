<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-[72.75rem] h-[43.75rem] rounded-2xl bg-white flex items-center justify-between p-10 relative shadow-xl">

        <!-- Imagem -->
        <div class="w-[31.125rem] h-[31.75rem] flex items-center">
            <img class="w-full" src="{{ asset('assets/images/bgRegister.png') }}" alt="Imagem de Login">
        </div>

        <!-- Linha vertical -->
        <div class="h-[80%] w-px bg-gray-400 absolute left-1/2 transform"></div>

        <!-- Formulário -->
        <form class="w-[25rem] flex flex-col justify-center items-start mr-12" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">

            <div class="mb-10">
                <h1 class="text-7xl text-gray-950 text-center">MindsHub</h1>
                <p class="text-blue-500 text-2xl text-center">Cadastre-se</p>
            </div>

            <div class="grid gap-6 w-full">
                <input type="text" name="name" placeholder="Nome completo" value="{{ old('name') }}"
                    class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950 w-full @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950 w-full @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Senha"
                        class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950 w-full pr-10 outline-none @error('password') border-red-500 @enderror">
                    <i class="fas fa-eye cursor-pointer absolute right-3 top-4 text-gray-500 toggle-password" data-target="password"></i>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha"
                        class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950 w-full pr-10 outline-none">
                    <i class="fas fa-eye cursor-pointer absolute right-3 top-4 text-gray-500 toggle-password" data-target="password_confirmation"></i>
                    <p id="confirmPasswordError" class="text-red-500 text-sm hidden mt-1">As senhas não coincidem!</p>
                </div>
            </div>

            <div class="block mt-4">
                <label for="terms" class="inline-flex items-center">
                    <input id="terms" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="terms" required>
                    <span class="ml-2 text-sm text-gray-600">Aceito os <a class="text-blue-500 hover:underline" href="#">termos e condições</a></span>
                </label>
                @error('terms')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-blue-500 text-white text-xl rounded-lg py-3 mt-10 w-full hover:bg-blue-700 transition" type="submit">
                Cadastrar
            </button>

            <div class="w-full h-px bg-gray-400 mt-10"></div>

            <p class="text-gray-950 text-lg mt-4">
                Possui uma conta?
                <a class="text-blue-500 hover:underline" href="{{ route('login') }}">Entrar</a>
            </p>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const password = document.getElementById("password");
            const confirm = document.getElementById("password_confirmation");
            const error = document.getElementById("confirmPasswordError");

            function checkPasswords() {
                if (password.value !== confirm.value) {
                    error.classList.remove("hidden");
                } else {
                    error.classList.add("hidden");
                }
            }

            password.addEventListener("input", checkPasswords);
            confirm.addEventListener("input", checkPasswords);

            document.querySelectorAll(".toggle-password").forEach(icon => {
                icon.addEventListener("click", function () {
                    const target = document.getElementById(this.dataset.target);
                    if (target.type === "password") {
                        target.type = "text";
                        this.classList.replace("fa-eye", "fa-eye-slash");
                    } else {
                        target.type = "password";
                        this.classList.replace("fa-eye-slash", "fa-eye");
                    }
                });
            });
        });
    </script>
</body>
</html>
