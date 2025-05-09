<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mindshub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<style>
  .bg-custom {
    background-image: url('./bgLadingPage.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }
</style>


<body
  style="background-image: url('bgLadingPage.jpg'); background-size: cover; background-position: center;"
  class="h-screen flex flex-col">

  <div class="flex justify-between p-8 items-center">
    <img src="./logoLading.png" alt="">
    <div class="text-2xl text-white bg-blue-500 px-6 rounded-lg py-3 hover:bg-blue-600 transition-all duration-300">
        <a href="{{ route('login')}}">
            Login /
        </a>
        <a href="{{ route('typeuser.page') }}">
            Cadastro
        </a>
    </div>
  </div>

  <div class="text-white grid items-center justify-items-center mt-20">
    <p class="text-6xl font-bold">Aprender nunca foi tão divertido</p>
    <p class="text-3xl mb-6">Gamifique seus estudos com desafios, rankings e recompensa.</p>
    <button class="bg-blue-500 hover:bg-blue-600 transition-all px-6 py-3 text-2xl rounded-lg duration-300">Comece agora mesmo</button>
  </div>

</body>

</html>