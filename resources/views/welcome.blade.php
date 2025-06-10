<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Mindshub')</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bg-custom {
            background-image: url('{{ asset('assets/images/bgLadingPage.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-custom h-screen flex flex-col">
    <!-- Conteúdo Principal -->
    <main class="flex-1 p-4 text-center">
        <!-- Cabeçalho e conteúdo principal -->
        <div class="flex justify-between p-8 items-center">
            <img src="{{ asset('assets/images/logoLading.png') }}" alt="Logo" class="h-12">
            <div class="text-2xl text-white bg-blue-500 px-6 rounded-lg py-3 hover:bg-blue-600 transition-all duration-300 space-x-2">
                <a href="{{ route('login')}}" class="no-underline">
                    Login /
                </a>
                <a href="{{ route('typeuser.page') }}" class="no-underline">
                    Cadastro
                </a>
            </div>
        </div>

        <div class="text-white grid items-center justify-items-center mt-20">
            <p class="text-6xl font-bold drop-shadow-lg">Aprender nunca foi tão divertido</p>
            <p class="text-3xl mb-6 drop-shadow">Gamifique seus estudos com desafios, rankings e recompensa.</p>

            <a href="{{ route('typeuser.page') }}"
               class="bg-blue-500 hover:bg-blue-600 transition-all px-6 py-3 text-2xl rounded-lg duration-300 shadow-lg">
               Comece agora mesmo
            </a>
        </div>
    </main>
</body>

</html>
