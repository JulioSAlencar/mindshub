{{-- Sidebar Compacta --}}
<aside id="sidebar" class="fixed top-0 left-0 bottom-0 w-20 bg-slate-900 flex flex-col items-center transition-all duration-500 overflow-hidden">
  <a href="{{ route('dashboard') }}">
    <img id="sidebar-logo" class="w-14 py-3" src="{{ asset('assets/images/logoSideBar.svg') }}" alt="Logo">
  </a>

  <nav class="mt-14 px-6">
    <div class="flex items-center text-white flex-col gap-8">
      <button id="menu-toggle" class="text-blue-500 text-xl hover:scale-125 hover:text-white transition duration-300">
        <i class="fas fa-bars"></i>
      </button>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('dashboard') }}">
        <i class="fas fa-home"></i>
      </a>

      @can('is-teacher')
        <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('disciplines.page') }}">
          <i class="fa-solid fa-chalkboard"></i>
        </a>
      @endcan

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('disciplines.participating') }}">
        <i class="fas fa-book"></i>
      </a>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('ranking.global') }}">
        <i class="fas fa-trophy"></i>
      </a>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('trails.show') }}">
        <i class="fas fa-flag"></i>
      </a>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('profile.show') }}">
        <i class="fas fa-cog"></i>
      </a>
    </div>
  </nav>
</aside>

{{-- Sidebar Expandida --}}
<aside id="sidebar-expanded" class="fixed top-0 left-0 bottom-0 w-48 bg-slate-900 flex flex-col transition-all duration-500 overflow-hidden hidden">
  <img id="sidebar-logo-expanded" class="w-36 py-3 mx-auto" src="{{ asset('assets/images/logoSideBarOpen.svg') }}" alt="Logo Expandido">

  <nav class="mt-14 px-6">
    <div class="flex flex-col text-white gap-8 text-lg">

      <button id="menu-close" class="flex items-center gap-3 text-blue-500 text-xl hover:text-white hover:translate-x-1 transition">
        <i class="fas fa-bars"></i> <span class="font-bold">Menu</span>
      </button>

      <a href="{{ route('dashboard') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-home text-xl"></i> Dashboard
      </a>

      @can('is-teacher')
        <a href="{{ route('disciplines.page') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
          <i class="fa-solid fa-chalkboard text-xl"></i> Gerenciar
        </a>
      @endcan

      <a href="{{ route('disciplines.participating') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-book text-xl"></i> Disciplinas
      </a>

      <a href="{{ route('ranking.global') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-trophy text-xl"></i> Ranking
      </a>

      <a href="{{ route('trails.show') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-flag text-xl"></i> Trilhas
      </a>

      <a href="{{ route('profile.show') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-cog text-xl"></i> Perfil
      </a>
    </div>
  </nav>
</aside>

{{-- Script para alternar entre os menus --}}
<script>
  document.getElementById('menu-toggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.add('hidden');
    document.getElementById('sidebar-expanded').classList.remove('hidden');
  });

  document.getElementById('menu-close').addEventListener('click', function () {
    document.getElementById('sidebar-expanded').classList.add('hidden');
    document.getElementById('sidebar').classList.remove('hidden');
  });
</script>
