<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Senha</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="bg-white w-full max-w-2xl p-10 rounded-2xl shadow-xl">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Criar Nova Senha</h1>

    <form method="POST" action="{{ route('password.store') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
        <input id="email" name="email" type="email"
          class="w-full p-3 rounded-lg bg-gray-200 placeholder-gray-600 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="{{ old('email', $request->email) }}" required autocomplete="username" autofocus>
        @error('email')
          <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Nova Senha -->
      <div class="mb-4">
        <label for="password" class="block text-gray-700 font-semibold mb-2">Nova Senha</label>
        <input id="password" name="password" type="password"
          class="w-full p-3 rounded-lg bg-gray-200 placeholder-gray-600 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
          required autocomplete="new-password">
        @error('password')
          <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Confirmar Nova Senha -->
      <div class="mb-6">
        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar Senha</label>
        <input id="password_confirmation" name="password_confirmation" type="password"
          class="w-full p-3 rounded-lg bg-gray-200 placeholder-gray-600 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
          required autocomplete="new-password">
        @error('password_confirmation')
          <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <button
        class="w-full bg-blue-500 hover:bg-blue-700 transition text-white py-3 rounded-lg text-lg font-semibold"
        type="submit">
        Redefinir Senha
      </button>
    </form>
  </div>
</body>

</html>
