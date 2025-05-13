<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Mindshub')</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])

    <style>
        .bg-custom {
            background-image: url('{{ asset('assets/images/bgLadingPage.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
    
</head>

<body class="bg-custom h-screen flex flex-col">

    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-header" class="flex flex-col flex-1 ml-20">
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex-1 p-4 text-center">
                <!-- Cabeçalho e conteúdo principal -->
                <div class="flex justify-between p-8 items-center">
                    <img src="{{ asset('assets/images/logoLading.png') }}" alt="Logo" class="h-12">
                    <button class="text-2xl text-white bg-blue-500 px-6 rounded-lg py-3 hover:bg-blue-600 transition-all duration-300">Login/Cadastro</button>
                </div>

                <div class="text-white grid items-center justify-items-center mt-20">
                    <p class="text-6xl font-bold">Aprender nunca foi tão divertido</p>
                    <p class="text-3xl mb-6">Gamifique seus estudos com desafios, rankings e recompensa.</p>
                    <button class="bg-blue-500 hover:bg-blue-600 transition-all px-6 py-3 text-2xl rounded-lg duration-300">Comece agora mesmo</button>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</body>

</html>
