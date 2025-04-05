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
    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-header" class="flex flex-col flex-1">
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex-1 p-4 items-center justify-items-center">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</body>

</html>