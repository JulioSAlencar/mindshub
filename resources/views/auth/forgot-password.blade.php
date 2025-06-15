<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white w-100 max-w-lg p-10 rounded-2xl shadow-xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Redefinir Senha</h1>
        <p class="text-gray-600 mb-6">
            Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e nós lhe enviaremos um link
            de redefinição para você criar uma nova.
        </p>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input id="email" name="email" type="email"
                    class="w-full p-3 rounded-lg bg-gray-200 placeholder-gray-600 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button
                class="w-full bg-blue-500 hover:bg-blue-700 transition text-white py-3 rounded-lg text-lg font-semibold"
                type="submit">
                Enviar Link de Redefinição
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">
                Voltar para login
            </a>
        </div>
    </div>
</body>

</html>
