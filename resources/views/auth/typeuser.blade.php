<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tipo de usuario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-700 h-screen flex items-center justify-center">
    <div class="w-[72.75rem] h-[43.75rem] rounded-2xl bg-gray-900 flex items-center justify-between p-10 relative">

        <!-- Imagem de fundo -->
        <div class="w-[31.125rem] h-[31.75rem] flex items-center">
            <img class="w-full" src="{{ asset('assets/images/bgLogin.png') }}" alt="Imagem de Login">
        </div>

        <!-- Linha divisória vertical -->
        <div class="h-[80%] w-px bg-white absolute left-1/2 transform -translate-x-1/2"></div>

        <!-- Formulário -->
        <form class="w-[25rem] flex flex-col justify-center items-start mr-12" action="">
            <div class="mb-10">
                <h1 class="text-7xl text-white">MindsHub</h1>
                <p class="text-white text-2xl mt-5">Qual tipo de usuario <span class="text-purple-500">você é?!</span></p>
            </div>

            <a href="{{ route('register', ['role' => 'student']) }}">
                <button class="bg-purple-900 text-white text-xl rounded-lg py-3 mt-10 w-full" type="button">Registrar como Aluno</button>
            </a>
            <br>
            <a href="{{ route('register', ['role' => 'teacher']) }}">
                <button class="bg-purple-900 text-white text-xl rounded-lg py-3 mt-10 w-full" type="button">Registrar como Professor</button>
            </a>

            <!-- Linhas horizontais -->
            <div class="w-full h-px bg-white mt-10"></div>

            <p class="text-white text-lg mt-4">Já possui conta?
                <a class="text-purple-500 hover:underline" href="{{ route('login') }}">Faça Login</a>
            </p>
        </form>

    </div>
</body>

</html>
