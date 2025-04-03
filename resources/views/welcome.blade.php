<!DOCTYPE html>
<html lang="en">

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
        <a href="{{ route('register', ['role' => 'student']) }}">
            <button type="button">Registrar como Aluno</button>
        </a>
        <br>
        <a href="{{ route('register', ['role' => 'teacher']) }}">
            <button type="button">Registrar como Professor</button>
        </a>
    </div>
</body>

</html>