<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificação de Email</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="bg-white w-full max-w-lg p-10 rounded-2xl shadow-xl">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Verifique seu Email</h1>
    <p class="text-gray-600 mb-6">
      Obrigado por se cadastrar! Antes de começar, por favor verifique seu endereço de e-mail clicando no link que enviamos.
      Caso não tenha recebido, reenviaremos com prazer.
    </p>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 text-sm text-green-600 font-medium">
        Um novo link de verificação foi enviado para o e-mail informado.
      </div>
    @endif

    <div class="flex items-center justify-between mt-6">
      <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button
          class="bg-blue-500 hover:bg-blue-700 transition text-white py-2 px-4 rounded-lg text-sm font-semibold"
          type="submit">
          Reenviar Email de Verificação
        </button>
      </form>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
          class="text-sm text-gray-600 hover:text-gray-900 underline transition"
          type="submit">
          Sair
        </button>
      </form>
    </div>
  </div>
</body>

</html>
