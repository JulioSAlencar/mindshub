<aside id="sidebar" class="fixed top-0 left-0 bottom-0 w-20 bg-slate-900 flex flex-col items-center transition-all duration-500 overflow-hidden">
  <img id="sidebar-logo" class="w-14 py-3" src="{{ asset('assets/images/logoSideBar.svg') }}" alt="">

  <nav class="mt-24">
    <div class="flex items-center text-3xl text-white flex-col gap-8">
      <i id="menu-toggle" class="fas fa-bars text-blue-500 cursor-pointer hover:scale-125 hover:text-white transition-all duration-300"></i>

      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="#"><i class="fas fa-home"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="#"><i class="fas fa-file-alt"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="#"><i class="fas fa-truck"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="#"><i class="fas fa-route"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="#"><i class="fas fa-folder"></i></a>
      <a class="hover:translate-x-1 hover:text-blue-500 transition-all duration-300" href="#"><i class="fas fa-user"></i></a>
    </div>
  </nav>
</aside>


<aside id="sidebar-expanded" class="fixed top-0 left-0 bottom-0 w-48 bg-slate-900 flex flex-col transition-all duration-500 overflow-hidden hidden">
  <img id="sidebar-logo-expanded" class="w-36 py-3 mx-auto" src="{{ asset('assets/images/logoSideBarOpen.svg') }}" alt="">

  <nav class="mt-20">
    <div class="flex flex-col text-white gap-10 px-6 text-xl">
      <i id="menu-close" class="fas fa-bars text-3xl text-blue-500 cursor-pointer hover:translate-x-1 hover:text-white transition-all duration-300"></i>

      <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-home text-3xl"></i>
        <p class="text-lg">Dashboard</p>
      </a>
      <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-file-alt text-3xl"></i>
        <p class="text-lg">Motorista</p>
      </a>
      <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-truck text-3xl"></i>
        <p class="text-lg">Caminhão</p>
      </a>
      <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-route text-3xl"></i>
        <p class="text-lg">Rotas</p>
      </a>
      <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-folder text-3xl"></i>
        <p class="text-lg">Relatórios</p>
      </a>
      <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300">
        <i class="fas fa-user text-3xl"></i>
        <p class="text-lg">Motorista</p>
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