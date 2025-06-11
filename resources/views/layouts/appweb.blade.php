<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mindshub')</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100 h-screen flex flex-col">
<!-- Conteúdo Principal -->
    <main class="flex-1 p-4">
        @yield('content')
    </main>
</body>

</html>