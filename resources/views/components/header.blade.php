<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<header class="relative bg-white h-12 flex items-center justify-end p-2.5 border-b">

  <form action="{{ route('dashboard') }}" method="GET">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar disciplina">
    <button type="submit">Buscar</button>
  </form>

  <div class="flex items-center gap-4 text-2xl">
        {{-- Foto de perfil --}}
        @auth
            @if (Auth::user()->profile_photo)
                <img src="{{ asset(Auth::user()->profile_photo) }}"
                    alt="Foto de perfil"
                    class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
            @else
                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-sm text-white">
                    <img src="{{ asset('assets/profile_photos/default.png') }}" alt="Imagem padrão" class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
                </div>
            @endif
        @endauth
    </div>
  <!-- @auth
        @can('is-student')
            <p class="font-semibold mr-10">Aluno: {{ Auth::user()->name }}</p>
        @elsecan('is-teacher')
            <p class="font-semibold mr-10">Professor: {{ Auth::user()->name }}</p>
        @else
            <p class="font-semibold mr-10">Você não está logado</p>
        @endcan
    @endauth -->

  <!-- enquanto a autenticação está desligada -->
  @auth
  @if (Auth::user()->role === 'student')
  <p class="font-semibold mr-10">Aluno: {{ Auth::user()->name }}</p>
  @else (Auth::user()->role === 'teacher')
  <p class="font-semibold mr-10">Professor: {{ Auth::user()->name }}</p>
  @endif
  @else
  <p class="font-semibold mr-10">Você não está logado</p>
  @endauth

  <div class="flex items-center gap-3 text-2xl">
    {{-- Notificação (só exemplo) --}}
    <a class="flex items-center gap-1.5 p-2 transition-all duration-300 ease-in-out hover:-translate-x-1 hover:text-blue-700 text-blue-500" href="#">
        <i class="fas fa-bell"></i>
    </a>

    {{-- Botão de logout --}}
    <a
        href="#"
        class="flex items-center gap-1.5 p-2 transition-all duration-300 ease-in-out hover:translate-x-1 text-blue-500 hover:text-red-500"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    >
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
    </a>

    {{-- Formulário escondido --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>


</header>