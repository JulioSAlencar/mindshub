<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindshub - Escolha seu Tipo de Usuário</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-xl shadow-lg flex w-[62.5rem] p-8">
        <!-- Imagem -->
        <div class="w-1/2 flex items-center justify-center">
            <img src="{{ asset('assets/images/tipoUserImg.svg') }}" alt="Ilustração de professores e alunos" class="max-w-full">
        </div>

        <!-- Linha divisória -->
        <div class="w-px bg-gray-300 mx-6"></div>

        <!-- Formulário de escolha -->
        <div class="w-1/2 flex flex-col justify-center">
            <h1 class="text-7xl text-gray-950 text-center">Mindshub</h1>
            <p class="text-gray-800 text-2xl mt-2 text-center">Que tipo de usuário <span class="text-blue-500 font-semibold">Você</span> é?!</p>

            <div class="mt-6 flex flex-col gap-4">
                <a href="{{ route('register', ['role' => 'teacher']) }}" class="bg-blue-500 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700 transition mt-14">
                    Sou professor
                </a>
                <a href="{{ route('register', ['role' => 'student']) }}" class="bg-blue-500 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700 transition mt-7">
                    Sou aluno
                </a>
            </div>

            <!-- Linha decorativa -->
            <div class="flex justify-between items-center mt-14">
                <span class="w-1/3 h-px bg-gray-300"></span>
                <span class="w-1/3 h-px bg-gray-300"></span>
            </div>

            <!-- Link para login -->
            <p class="text-center text-gray-600 mt-14">
                Possui uma conta?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Entrar</a>
            </p>
        </div>
    </div>
</body>

</html>
