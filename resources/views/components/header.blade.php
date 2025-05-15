<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<header class="bg-white border-b shadow-sm p-4 flex justify-between items-center flex-wrap gap-4">

  <!-- Formulário de busca -->
  <form action="{{ route('dashboard') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
    <input 
      type="text" 
      name="search" 
      value="{{ request('search') }}" 
      placeholder="Buscar disciplina"
      class="border border-gray-300 rounded px-3 py-1 w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-400"
    >
    <button 
      type="submit"
      class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition"
    >
      Buscar
    </button>
  </form>

  <!-- Lado direito: perfil, nome, ícones -->
  <div class="flex items-center gap-6">

    <!-- Nome e papel do usuário -->
    <div class="text-sm font-medium text-gray-700 hidden md:block">
      @auth
        @if (Auth::user()->role === 'student')
          Aluno: {{ Auth::user()->name }}
        @else
          Professor: {{ Auth::user()->name }}
        @endif
      @else
        Você não está logado
      @endauth
    </div>

    <!-- Foto de perfil -->
    @auth
      <div>
        @if (Auth::user()->profile_photo)
          <img 
            src="{{ asset(Auth::user()->profile_photo) }}" 
            alt="Foto de perfil"
            class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow"
          >
        @else
          <img 
            src="{{ asset('assets/profile_photos/default.png') }}" 
            alt="Imagem padrão" 
            class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow"
          >
        @endif
      </div>
    @endauth

    <!-- Ícones de ação -->
    <div class="flex items-center gap-4 text-blue-600 text-xl">
      <!-- Notificação -->
      <a 
        href="#" 
        class="hover:text-blue-800 transition transform hover:-translate-y-0.5"
      >
        <i class="fas fa-bell"></i>
      </a>

      <!-- Logout -->
      <a 
        href="#" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="hover:text-red-600 transition transform hover:translate-x-0.5"
      >
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
      </a>

      <!-- Formulário de logout -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
      </form>
    </div>

  </div>
</header>
