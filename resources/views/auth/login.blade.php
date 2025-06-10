<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite('resources/css/app.css')
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

@if (session('suggest_password_reset'))
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 shadow-xl">
        <div class="bg-white rounded-xl shadow-2xl p-6 w-11/12 max-w-sm transform transition-all duration-300">
            <div class="flex items-start gap-4">
                <!-- Ícone de alerta -->
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>

                <!-- Mensagem -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Atenção!</h3>
                    <p class="mt-2 text-sm text-gray-700">
                        Você errou a senha 5 ou mais vezes. Recomendamos que clique em
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 underline font-medium">
                            'Esqueceu sua senha?'
                        </a> 
                        para redefini-la.
                    </p>
                </div>
            </div>

            <!-- Botão de ação -->
            <div class="mt-5 flex justify-end">
                <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Entendido
                </button>
            </div>
        </div>
    </div>

    <script>
        // Fecha o alerta ao pressionar ESC
        document.addEventListener('keydown', (e) => {
            if(e.key === 'Escape') {
                const alert = document.querySelector('.fixed');
                if(alert) alert.remove();
            }
        });
    </script>
@endif


  <div class="w-[72.75rem] h-[43.75rem] rounded-2xl bg-white flex items-center justify-between p-10 relative shadow-xl">
    
    <!-- Imagem de fundo -->
    <div class="w-[31.125rem] h-[31.75rem] flex items-center">
      <img 
        class="w-full" 
        src="{{ asset('assets/images/bgLogin.png') }}" 
        alt="Imagem de Login"
      >
    </div>

    <!-- Linha divisória vertical -->
    <div class="h-[80%] w-px bg-gray-400 absolute left-1/2 transform -translate-x-1/2"></div>

    <!-- Formulário -->
    <form 
      class="w-[25rem] flex flex-col justify-center items-start mr-12" 
      method="POST" 
      action="{{ route('login') }}"
    >
      @csrf
      
      <div class="mb-10">
        <h1 class="text-7xl text-gray-950">MindsHub</h1>
        <p class="text-gray-950 text-2xl mt-5">
          Seja <span class="text-blue-500">Bem-Vindo!</span>
        </p>
      </div>

      <!-- Mensagem de status -->
      @if (session('status'))
        <div class="text-green-600 text-sm mb-4">
          {{ session('status') }}
        </div>
      @endif

      <!-- Campo Email -->
      <div class="grid gap-6 w-full">
        <input 
          type="email" 
          name="email" 
          placeholder="Email" 
          value="{{ old('email') }}"
          class="bg-gray-200 rounded-lg text-lg border-none p-3 text-black placeholder-black w-full"
        >
      </div>
      
      @if ($errors->has('email'))
        <div class="text-red-600 text-sm mb-2 mt-1">
          {{ $errors->first('email') }}
        </div>
      @endif

      <!-- Campo Senha -->
      <div class="grid gap-6 w-full mt-6">
        <input 
          type="password" 
          name="password" 
          placeholder="Senha"
          class="bg-gray-200 rounded-lg text-lg border-none p-3 text-black placeholder-black w-full"
        >
      </div>
      
      @if ($errors->has('password'))
        <div class="text-red-600 text-sm mb-2 mt-1">
          {{ $errors->first('password') }}
        </div>
      @endif

      <!-- Lembrar de mim -->
      <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
          <input 
            id="remember_me" 
            type="checkbox" 
            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
            name="remember"
          >
          <span class="ml-2 text-sm text-gray-600">
            {{ __('Lembrar de mim') }}
          </span>
        </label>
      </div>

      <!-- Botão de Submit -->
      <button 
        class="bg-blue-500 text-white text-xl rounded-lg py-3 mt-10 w-full hover:bg-blue-700 transition" 
        type="submit"
      >
        Entrar
      </button>

      <!-- Divisor -->
      <div class="w-full h-px bg-gray-400 mt-10"></div>

      <!-- Links Adicionais -->
      <p class="text-gray-950 text-lg mt-4">
        Ainda não possui conta?
        <a 
          class="text-blue-500 hover:underline" 
          href="{{ route('typeuser.page') }}"
        >
          Se registre agora!
        </a>
      </p>
      
      <div class="flex justify-center w-full mt-2">
        <a 
          class="text-blue-500 hover:underline" 
          href="{{ route('password.request') }}"
        >
          Esqueceu sua senha?
        </a>
      </div>
    </form>
  </div>
</body>
</html>