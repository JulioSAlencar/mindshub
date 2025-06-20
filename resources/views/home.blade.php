<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindshub</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100 h-screen flex flex-col">
    <div class="relative flex flex-1 ">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-header" class="flex flex-col flex-1">
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex-1 p-4 items-center justify-items-center">

                <h1 class="text-3xl font-semibold block mb-4">Minds <sapn class="text-blue-500">Hub</sapn>
                </h1>


                <a href="{{ route('login') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition mr-4">
                    Login
                </a>

                <a href="{{ route('escolhaUsuario.page') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition">
                    Cadastro
                </a>

            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

</body>

</html>
