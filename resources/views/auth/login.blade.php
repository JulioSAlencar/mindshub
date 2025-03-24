<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <p class="text-white text-2xl mt-5">Seja <span class="text-purple-500">Bem-Vindo!</span></p>
            </div>

            <div class="grid gap-6 w-full">
                <input type="email" name="email" placeholder="Email"
                    class="bg-gray-600 rounded-lg text-lg border-none p-3 text-white">
                <input type="password" name="password" placeholder="Senha"
                    class="bg-gray-600 rounded-lg text-lg border-none p-3 text-white">
            </div>

            <button class="bg-purple-900 text-white text-xl rounded-lg py-3 mt-10 w-full" type="submit">Entrar</button>

            <!-- Linhas horizontais -->
            <div class="w-full h-px bg-white mt-10"></div>

            <p class="text-white text-lg mt-4">Ainda não possui conta? Entre em contato com a
                <a class="text-purple-500 hover:underline" href="#">Secretária!</a>
            </p>
        </form>

    </div>
</body>

</html>