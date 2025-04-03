<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-[72.75rem] h-[43.75rem] rounded-2xl bg-white flex items-center justify-between p-10 relative shadow-xl">

        <!-- Imagem de fundo -->
        <div class="w-[31.125rem] h-[31.75rem] flex items-center">
            <img class="w-full" src="{{ asset('assets/images/bgRegister.png') }}" alt="Imagem de Login">
        </div>

        <!-- Linha divisória vertical -->
        <div class="h-[80%] w-px bg-gray-400 absolute left-1/2 transform"></div>

        <!-- Formulário -->
        <form class="w-[25rem] flex flex-col justify-center items-start mr-12" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-10">
                <h1 class="text-7xl text-gray-950 text-center">MindsHub</h1>
                <p class="text-blue-500 text-2xl text-center">Cadastre-se</p>
            </div>

            <div class="grid gap-6 w-full">
                <input type="text" name="nomeCompleto" placeholder="Nome completo"
                    class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950">

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950">

                <div>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Senha"
                            class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950 w-full pr-10 outline-none">
                        <i class="fas fa-eye cursor-pointer absolute right-3 top-4 text-gray-500 toggle-password" data-target="password"></i>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmar senha"
                            class="bg-gray-200 rounded-lg text-lg border-none p-3 text-gray-950 w-full pr-10 outline-none">
                        <i class="fas fa-eye cursor-pointer absolute right-3 top-4 text-gray-500 toggle-password" data-target="confirmPassword"></i>
                    </div>
                    <p id="confirmPasswordError" class="text-red-500 text-sm hidden mt-1">As senhas não coincidem!</p>
                </div>

            </div>
            <!-- Termos e condições -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Aceito os <a class="text-blue-500 hover:underline" href="#">termos e condições</a></span>
                </label>
            </div>

            <button class="bg-blue-500 hover text-white text-xl rounded-lg py-3 mt-10 w-full hover:bg-blue-700 transition" type="submit">Cadastrar</button>

            <!-- Linhas horizontais -->
            <div class="w-full h-px bg-gray-400 mt-10"></div>

            <p class="text-gray-950 text-lg mt-4">Possui uma conta?
                <a class="text-blue-500 hover:underline" href="{{ route('login') }}">Entrar</a>
            </p>
        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const confirmPasswordInput = document.getElementById("confirmPassword");
            const confirmPasswordError = document.getElementById("confirmPasswordError");
            const toggleIcons = document.querySelectorAll(".toggle-password");

            // Alternar visibilidade da senha
            toggleIcons.forEach(icon => {
                icon.addEventListener("click", function() {
                    const targetInput = document.getElementById(this.dataset.target);
                    if (targetInput.type === "password") {
                        targetInput.type = "text";
                        this.classList.replace("fa-eye", "fa-eye-slash");
                    } else {
                        targetInput.type = "password";
                        this.classList.replace("fa-eye-slash", "fa-eye");
                    }
                });
            });

            // Validação de senha
            function validatePasswords() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordError.classList.remove("hidden");
                } else {
                    confirmPasswordError.classList.add("hidden");
                }
            }

            passwordInput.addEventListener("input", validatePasswords);
            confirmPasswordInput.addEventListener("input", validatePasswords);
        });
    </script>
</body>

</html>