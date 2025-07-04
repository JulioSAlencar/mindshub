<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mindshub')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- ADICIONE ESTA LINHA --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100 h-screen flex flex-col">
    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-header" class="flex flex-col flex-1 ml-20">
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex-1 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</body>

</html>