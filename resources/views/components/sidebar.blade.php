<aside id="sidebar" class="fixed top-0 left-0 bottom-0 w-20 bg-slate-900 flex flex-col items-center transition-all duration-500 overflow-hidden">
  <a href="{{ route('dashboard') }}">
    <img id="sidebar-logo" class="w-14 py-3" src="{{ asset('assets/images/logoSideBar.svg') }}" alt="">
  </a>

  <nav class="mt-24">
    <div class="flex items-center text-3xl text-white flex-col gap-8">
      <i id="menu-toggle" class="fas fa-bars text-blue-500 cursor-pointer hover:scale-125 hover:text-white transition-all duration-300"></i>

      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="{{ route('disciplinas') }}"><i class="fas fa-book"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="{{ route('missoes') }}"><i class="fas fa-bullseye"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="{{ route('ranking') }}"><i class="fas fa-trophy"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="{{ route('trilhas') }}"><i class="fas fa-flag"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="{{ route('configuracoes') }}"><i class="fas fa-cog"></i></a>
    </div>
  </nav>
</aside>

<aside id="sidebar-expanded" class="fixed top-0 left-0 bottom-0 w-48 bg-slate-900 flex flex-col transition-all duration-500 overflow-hidden hidden">
  <img id="sidebar-logo-expanded" class="w-36 py-3 mx-auto" src="{{ asset('assets/images/logoSideBarOpen.svg') }}" alt="">

  <nav class="mt-20">
    <div class="flex flex-col text-white gap-10 px-6 text-xl">
      <i id="menu-close" class="fas fa-bars text-3xl text-blue-500 cursor-pointer hover:translate-x-1 hover:text-white transition-all duration-300"></i>

      <a href="{{ route('dashboard') }}" class="flex items-center gap-4 hover:scale-125 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-home text-3xl"></i>
        <p class="text-lg">Dashboard</p>
      </a>
      <a href="{{ route('disciplinas') }}" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-book text-3xl"></i>
        <p class="text-lg">Disciplinas</p>
      </a>
      <a href="{{ route('missoes') }}" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-bullseye text-3xl"></i>
        <p class="text-lg">Missões</p>
      </a>
      <a href="{{ route('ranking') }}" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-trophy text-3xl"></i>
        <p class="text-lg">Ranking</p>
      </a>
      <a href="{{ route('trilhas') }}" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-flag text-3xl"></i>
        <p class="text-lg">Trilhas</p>
      </a>
      <a href="{{ route('configuracoes') }}" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-cog text-3xl"></i>
        <p class="text-lg">Configurações</p>
      </a>
    </div>
  </nav>
</aside>

<script>
  document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('sidebar').classList.add('hidden');
    document.getElementById('sidebar-expanded').classList.remove('hidden');
  });

  document.getElementById('menu-close').addEventListener('click', function() {
    document.getElementById('sidebar-expanded').classList.add('hidden');
    document.getElementById('sidebar').classList.remove('hidden');
  });
</script>
