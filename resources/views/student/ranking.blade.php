<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindshub</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100 h-screen flex flex-col">

  <div class="relative flex flex-1">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 bottom-0 w-20 bg-slate-900 flex flex-col items-center transition-all duration-500 overflow-hidden">
      <img id="sidebar-logo" class="w-14 py-3" src="assets/images/logoSideBar.svg" alt="">
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
      <img id="sidebar-logo-expanded" class="w-36 py-3 mx-auto" src="assets/images/logoSideBarOpen.svg" alt="">
      <nav class="mt-20">
        <div class="flex flex-col text-white gap-10 px-6 text-xl">
          <i id="menu-close" class="fas fa-bars text-3xl text-blue-500 cursor-pointer hover:translate-x-1 hover:text-white transition-all duration-300"></i>
          <a href="#" class="flex items-center gap-4 hover:scale-125 hover:text-blue-500 transition-all duration-300"><i class="fas fa-home text-3xl"></i><p class="text-lg">Dashboard</p></a>
          <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300"><i class="fas fa-file-alt text-3xl"></i><p class="text-lg">Motorista</p></a>
          <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300"><i class="fas fa-truck text-3xl"></i><p class="text-lg">Caminhão</p></a>
          <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300"><i class="fas fa-route text-3xl"></i><p class="text-lg">Rotas</p></a>
          <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300"><i class="fas fa-folder text-3xl"></i><p class="text-lg">Relatórios</p></a>
          <a href="#" class="flex items-center gap-4 hover:translate-x-1 hover:text-blue-500 transition-all duration-300"><i class="fas fa-user text-3xl"></i><p class="text-lg">Motorista</p></a>
        </div>
      </nav>
    </aside>

    <div id="main-header" class="flex flex-col flex-1 ml-20">
      <!-- Header -->
      <header class="relative bg-white h-12 flex items-center justify-end p-2.5 border-b -z-10">
        <p class="font-semibold mr-10">Você não está logado</p>
        <div class="flex items-center gap-3 text-2xl">
          <a class="flex items-center gap-1.5 p-2 transition-all duration-300 ease-in-out hover:-translate-x-1 hover:text-blue-700 text-blue-500" href=""><i class="fas fa-bell"></i></a>
          <a class="flex items-center gap-1.5 p-2 transition-all duration-300 ease-in-out hover:translate-x-1 text-blue-500 hover:text-red-500" href=""><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
      </header>

      <main>
        <!-- Aqui você pode colocar as páginas -->
        <h1 class="text-2xl font-bold mb-4 mt-8 flex items-center gap-2 ml-2">
           🏆Ranking dos  Alunos
        </h1>
        <main class="flex-1 p-8">
     
          <div class="flex items-center space-x-4 mb-6">
            <img src="imgs/circle-user-solid.svg" alt="Ícone Matemática" class="w-10 h-10" />
            <div>
              <h1 class="text-2xl font-semibold">Matemática</h1>
              <p class="text-sm text-gray-500">Prof. Julio Matheus • 2º ano B • 27 matérias</p>
            </div>
          </div>
    
    
          <h1 class="text-2xl font-bold text- mb-4 mt-8 flex items-center gap-2">
            📊 Ranking - Matemática
          </h1>
          
          <div class="bg-gray-900 text-white rounded-xl p-6 shadow-md w-full max-w-2xl">
            <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
              <span>🏆</span> Top Alunos
            </h2>
          
            <!-- Lista Turma -->
            <ul id="ranking-turma" class="space-y-3">
              <li class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                  <span class="text-yellow-400 text-xl">👑 #1</span>
                  <span>Manoel</span>
                </div>
                <span class="text-sm text-gray-300">1000 xp</span>
              </li>
              <li class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                  <span class="text-blue-400 text-xl">🥈 #2</span>
                  <span>Nycolas</span>
                </div>
                <span class="text-sm text-gray-300">942 xp</span>
              </li>
              <li class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                  <span class="text-orange-400 text-xl">🥉 #3</span>
                  <span>Ícaro</span>
                </div>
                <span class="text-sm text-gray-300">922 xp</span>
              </li>
            </ul>
          
            <!-- Tabela Global (inicialmente escondida) -->
            <div id="ranking-global" class="hidden mt-4">
              <table class="w-full text-sm text-left text-gray-300">
                <thead class="text-xs uppercase text-gray-400 border-b border-gray-700">
                  <tr>
                    <th class="py-2">Posição</th>
                    <th class="py-2">Nome</th>
                    <th class="py-2">XP</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-gray-800">
                    <td class="py-2">#4</td>
                    <td>Lucas</td>
                    <td>900</td>
                  </tr>
                  <tr class="border-b border-gray-800">
                    <td class="py-2">#5</td>
                    <td>Ana</td>
                    <td>880</td>
                  </tr>
                  <tr class="border-b border-gray-800">
                    <td class="py-2">#6</td>
                    <td>Fernanda</td>
                    <td>860</td>
                  </tr>
                </tbody>
              </table>
            </div>
          
            <!-- Botões de Filtro -->
          <div class="flex justify-end items-center mt-6 text-sm text-gray-400">

            <span class="mr-2">Ver:</span>
            <button id="btn-turma" class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs mr-2">Turma</button>
            <button id="btn-global" class="hover:underline">Global</button>
            
          </main>
  <!-- Footer -->
  <footer class="bg-slate-900 w-full p-5 mt-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-items-center gap-4 text-white">
      <div class="p-4"><img src="assets/images/logoFooter.png" alt=""></div>
      <div class="p-4">
        <h1 class="inline-block text-xl font-medium relative mb-4">Navegação<span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-blue-500"></span></h1>
        <ul class="grid gap-2">
          <a class="transition-all hover:text-blue-500" href="#"><li>DashBoard</li></a>
          <a class="transition-all hover:text-blue-500" href="#"><li>Disciplinas</li></a>
          <a class="transition-all hover:text-blue-500" href="#"><li>Configurações</li></a>
        </ul>
      </div>
      <div class="p-4">
        <h1 class="inline-block text-xl font-medium relative mb-4">Créditos & Parceiros<span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-blue-500"></span></h1>
        <ul class="grid gap-2">
          <a class="transition-all hover:text-blue-500" href="#"><li>Desenvolvido por The dry liter</li></a>
          <a class="transition-all hover:text-blue-500" href="#"><li>Programadores</li></a>
          <a class="transition-all hover:text-blue-500" href="#"><li>Gestão de Projeto</li></a>
        </ul>
      </div>
      <div class="p-4">
        <h1 class="inline-block text-xl font-medium relative mb-4">Suporte e contato<span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-white"></span></h1>
        <ul class="grid gap-2">
          <a class="transition-all hover:text-blue-500" href="#"><li>FAQ</li></a>
          <a class="transition-all hover:text-blue-500" href="#"><li>Termos de Uso</li></a>
          <a class="transition-all hover:text-blue-500" href="#"><li>Política de Privacidade</li></a>
          <a class="hover:text-white hover:underline" href="mailto:suporte@fleetmax.com"><li>suporte@mindshub.com</li></a>
        </ul>
      </div>
    </div>
    <div class="text-right text-white mt-4 p-4">
      <p>MindsHub © Alguns direitos reservados. 2025</p>
    </div>
  </footer>

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
  
  <script>
    function verStatus(nome) {
      // Pode ser redirecionamento, modal, alerta, etc
      alert("Abrindo status de " + nome);
      // Ou redirecionamento:
      // window.location.href = `/perfil-aluno.html?nome=${encodeURIComponent(nome)}`;
    }
  </script>
  
  <script>
    const btnTurma = document.getElementById('btn-turma');
    const btnGlobal = document.getElementById('btn-global');
    const rankingTurma = document.getElementById('ranking-turma');
    const rankingGlobal = document.getElementById('ranking-global');
  
    btnTurma.addEventListener('click', () => {
      rankingTurma.classList.remove('hidden');
      rankingGlobal.classList.add('hidden');
      btnTurma.classList.add('bg-blue-600', 'text-white');
      btnGlobal.classList.remove('text-blue-600');
    });
  
    btnGlobal.addEventListener('click', () => {
      rankingTurma.classList.add('hidden');
      rankingGlobal.classList.remove('hidden');
      btnTurma.classList.remove('bg-blue-600', 'text-white');
      btnGlobal.classList.add('text-blue-600');
    });
  </script>
  
  
  
</body>

</html>
