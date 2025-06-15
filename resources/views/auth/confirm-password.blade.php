<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmar Senha</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="bg-white w-full max-w-lg p-10 rounded-2xl shadow-xl">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Confirme sua Senha</h1>
    <p class="text-gray-600 mb-6">
      Esta é uma área segura do sistema. Por favor, confirme sua senha antes de continuar.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
      @csrf

      <div class="mb-4">
        <label for="password" class="block text-gray-700 font-semibold mb-2">Senha</label>
        <input id="password" name="password" type="password"
          class="w-full p-3 rounded-lg bg-gray-200 placeholder-gray-600 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
          required autocomplete="current-password">
        @error('password')
          <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <button
        class="w-full bg-blue-500 hover:bg-blue-700 transition text-white py-3 rounded-lg text-lg font-semibold"
        type="submit">
        Confirmar
      </button>
    </form>
  </div>
</body>

</html>
