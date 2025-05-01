<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindshub</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-500">
    <h1>Good luck in front-end!</h1>
    <duv class="login">
        <a href="{{ route('login')}}">
            Login
        </a>
    </duv>
    <div class="registro">
        <a href="{{ route('typeuser.page') }}">
            Cadastro
        </a>
    </div>
</body>

</html>