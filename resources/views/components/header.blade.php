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
    <div class="relative" x-data="{ open: false }">
        <a href="#" @click.prevent="open = !open" class="relative">
            <i class="fas fa-bell"></i>
            @if(Auth::check() && $unreadNotifications->count() > 0)
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                    {{ $unreadNotifications->count() }}
                </span>
            @endif
        </a>

        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded shadow-lg p-4 z-50">
            <h4 class="text-lg font-bold mb-2">Notificações</h4>
            <form action="{{ route('notifications.markAllRead') }}" method="POST" class="text-right mb-2">
                  @csrf
                  <button type="submit" class="text-sm text-blue-600 hover:underline">
                      Marcar todas como lidas
                  </button>
            </form>
            @forelse($unreadNotifications as $notification)
                  <div class="mb-2 border-b pb-3 flex items-start gap-3">
                      {{-- Ícone da medalha --}}
                      <div class="w-16 h-16 flex items-center justify-center">
                          <img src="{{ asset($notification->data['icon']) }}" alt="Medal Icon" class="w-14 h-14 object-contain">
                      </div>
                      {{-- Conteúdo da notificação --}}
                      <div class="flex-1">
                        <a href="{{ route('notifications.read', $notification->id) }}" class="block hover:bg-gray-50 p-2 rounded transition">
                            <p class="text-sm font-semibold text-gray-800">
                                Medalha conquistada: <span class="text-blue-600">{{ $notification->data['name'] }}</span>
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $notification->data['description'] }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                Recebida em {{ $notification->created_at->format('d/m/Y H:i') }}
                            </p>
                          </a>
                      </div>
                  </div>
              @empty
                  <p class="text-gray-500 text-sm">Sem notificações novas.</p>
              @endforelse
        </div>
    </div>


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
