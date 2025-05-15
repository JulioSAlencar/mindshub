@extends('layouts.app')

@section('content')
<body class="bg-[#f5f6fa] font-sans p-6">
  <div class="max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-lg font-medium flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4S8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        Meu Perfil
      </h1>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-3 gap-4">
      <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
        <div class="w-10 h-10 bg-gray-300 rounded-full">        {{-- Foto de perfil --}}
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
        <div>
          <p class="font-medium">Nycolas Galdino</p>
          <p class="text-xs text-gray-500">nycolasgaldino@gmail.com</p>
        </div>
        <a class="ml-auto px-3 py-1 border text-sm rounded border-blue-500 text-blue-500 hover:bg-blue-50" href="{{ route('profile.edit')}}">Editar Perfil</a>
      </div>
      <div class="bg-white shadow rounded-lg p-4 text-center">
        <p class="text-xs text-gray-500">Total de XP acumulado</p>
        <p class="text-xl font-semibold">{{ $user->xp }}</p>
        {{-- <p class="text-green-500 text-xs">+350 esta semana</p> --}}
      </div>
      <div class="bg-white shadow rounded-lg p-4 text-center">
        <p class="text-xs text-gray-500">Nível Atual</p>
        <p class="text-xl font-semibold">{{ $user->level}}</p>
        {{-- <p class="text-green-500 text-xs">+4 posições nas últimas 2 semanas</p> --}}
      </div>
    </div>

  {{-- @can('is-teacher')
     <div class="bg-white shadow rounded-lg p-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggle('disciplinasExtras')">
          <h2 class="text-sm font-semibold text-gray-700">Minhas disciplinas</h2>
          <svg id="disciplinasExtrasIcon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </div>
        <ul class="mt-3 space-y-2">
          <li class="bg-gray-100 px-4 py-2 rounded flex justify-between"><span>Matemática</span><span class="text-sm text-gray-500">Prof. Nycolas</span></li>
          <li class="bg-gray-100 px-4 py-2 rounded flex justify-between"><span>Português</span><span class="text-sm text-gray-500">Prof. Ana</span></li>
        </ul>
        <ul id="disciplinasExtras" class="hidden mt-3 space-y-2">
          <li class="bg-gray-100 px-4 py-2 rounded flex justify-between"><span>História</span><span class="text-sm text-gray-500">Prof. João</span></li>
          <li class="bg-gray-100 px-4 py-2 rounded flex justify-between"><span>Geografia</span><span class="text-sm text-gray-500">Prof. Carla</span></li>
          <li class="bg-gray-100 px-4 py-2 rounded flex justify-between"><span>Ciências</span><span class="text-sm text-gray-500">Prof. Marina</span></li>
        </ul>
      </div>
  @endcan --}}
    <!-- Disciplinas -->
 <div class="bg-white shadow rounded-lg p-4">

    <!-- Preferências -->
    <div class="bg-white shadow rounded-lg p-4">
      <h2 class="text-sm font-semibold flex items-center gap-2 mb-4">
        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
        Preferências
      </h2>
      <div class="grid grid-cols-2 gap-3">
        <div class="bg-gray-100 rounded p-3">
          <p class="font-semibold text-sm">Trilha de carreira</p>
          <p class="text-blue-500 text-sm">Desenvolvimento de Software</p>
        </div>
        <div class="bg-gray-100 rounded p-3">
          <p class="font-semibold text-sm">Assunto Favorito</p>
          <p class="text-blue-500 text-sm">Lógica de Programação</p>
        </div>
        <div class="bg-gray-100 rounded p-3">
          <p class="font-semibold text-sm">Trilha de carreira</p>
          <p class="text-blue-500 text-sm">Engenharia de Dados</p>
        </div>
        <div class="bg-gray-100 rounded p-3">
          <p class="font-semibold text-sm">Assunto Favorito</p>
          <p class="text-blue-500 text-sm">Banco de Dados</p>
        </div>
      </div>
    </div>

    <!-- Feedback e Conquistas -->
    <div class="grid grid-cols-2 gap-4">
      <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-sm font-semibold flex items-center gap-2 mb-3 cursor-pointer" onclick="toggle('feedbackExtra')">
          <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v2H4zm0 4h10v2H4zm0 4h16v2H4z"/></svg>
          Feedback positivo
        </h2>
        <div class="space-y-2">
          <div class="bg-gray-100 rounded px-3 py-2 text-sm">
            "Excelente participação nas discussões em grupo!"
            <div class="text-xs text-gray-500">Prof. Pedro &mdash; 01/05</div>
          </div>
          <div class="bg-gray-100 rounded px-3 py-2 text-sm">
            "Ótimo desempenho na entrega de projetos!"
            <div class="text-xs text-gray-500">Prof. Ana &mdash; 25/04</div>
          </div>
          <div id="feedbackExtra" class="hidden">
            <div class="bg-gray-100 rounded px-3 py-2 text-sm">
              "Colaboração excelente em atividades em grupo."
              <div class="text-xs text-gray-500">Prof. Lucas &mdash; 15/04</div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-sm font-semibold flex items-center gap-2 mb-3 cursor-pointer" onclick="toggle('conquistasExtra')">
          <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
          Conquistas
        </h2>
        <div class="bg-gray-900 rounded-lg p-4 text-white text-center">
          <div class="text-pink-400 text-3xl mb-1">🧠</div>
          <p class="font-semibold">Nota perfeita</p>
          <p class="text-sm text-gray-300">Obteve 100% em qualquer avaliação</p>
          <p class="text-xs text-blue-400 mt-2">+250XP</p>
        </div>
        <div id="conquistasExtra" class="hidden mt-2">
          <div class="bg-gray-900 rounded-lg p-4 text-white text-center mt-2">
            <div class="text-yellow-400 text-3xl mb-1">🏅</div>
            <p class="font-semibold">Participação ativa</p>
            <p class="text-sm text-gray-300">Participou de todas as aulas do mês</p>
            <p class="text-xs text-blue-400 mt-2">+100XP</p>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal de Confirmação -->
  <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
      <h2 class="text-lg font-semibold mb-4">Encerrar sessão</h2>
      <p class="text-sm text-gray-600 mb-6">Você tem certeza que deseja sair da sua conta?</p>
      <div class="flex justify-end gap-3">
        <button onclick="toggleModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</button>
        <button onclick="confirmLogout()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Sair</button>
      </div>
    </div>
  </div>
  
  <script>
    
    function toggle(id) {
      const el = document.getElementById(id);
      const icon = document.getElementById(id + 'Icon');
      el.classList.toggle('hidden');
      if (icon) {
        icon.classList.toggle('rotate-90');
        icon.classList.toggle('rotate-270');
      }
    }

  </script>
@endsection