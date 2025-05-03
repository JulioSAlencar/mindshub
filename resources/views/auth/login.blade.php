<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="w-[72.75rem] h-[43.75rem] rounded-2xl bg-white flex items-center justify-between p-10 relative shadow-xl">

    <!-- Imagem de fundo -->
    <div class="w-[31.125rem] h-[31.75rem] flex items-center">
      <img class="w-full" src="{{ asset('assets/images/bgLogin.png') }}" alt="Imagem de Login">
    </div>

    <!-- Linha divisória vertical -->
    <div class="h-[80%] w-px bg-gray-400 absolute left-1/2 transform"></div>

    <!-- Formulário -->
    <form class="w-[25rem] flex flex-col justify-center items-start mr-12" method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-10">
        <h1 class="text-7xl text-gray-950">MindsHub</h1>
        <p class="text-gray-950 text-2xl mt-5">Seja <span class="text-blue-500">Bem-Vindo!</span></p>
      </div>

      <div class="grid gap-6 w-full">
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
          class="bg-gray-200 rounded-lg text-lg border-none p-3 text-black">
        <input type="password" name="password" placeholder="Senha"
          class="bg-gray-200 rounded-lg text-lg border-none p-3 text-black">
      </div>
      <!-- Remember Me -->
      <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
          <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
      </div>

      <button class="bg-blue-500 hover text-white text-xl rounded-lg py-3 mt-10 w-full hover:bg-blue-700 transition" type="submit">Entrar</button>

      <!-- Linhas horizontais -->
      <div class="w-full h-px bg-gray-400 mt-10"></div>

      <p class="text-gray-950 text-lg mt-4">Ainda não possui conta?
        <a class="text-blue-500 hover:underline" href="{{ route('typeuser.page') }}">Se registre agora!</a>
      </p>
      
      <a href="{{ route('password.request') }}">Esqueci minha senha</a>
    </form>

  </div>
</body>

</html>
