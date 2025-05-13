@extends('layouts.app')

@section('content')

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
    
    <div class="">
                 <!-- Barra de Pesquisa e Filtro -->
  <div class="flex flex-col md:flex-row md:items-center md:gap-2 mb-4">
  
    <!-- Barra de pesquisa -->
    <div class="flex items-center bg-gray-800 rounded-full px-4 py-2 w-full md:w-auto flex-grow">
      <img src="" alt="">
      <input id="search-aluno" type="text" placeholder="Pesquisar aluno..." class="bg-transparent focus:outline-none text-white w-full" />
    </div>

    <!-- Filtro -->
    <div class="mt-2 md:mt-0">
      <select class="bg-gray-800 text-white rounded-full px-4 py-2 text-sm">
       <option value="todos">Todos os anos</option>
        <option value="1ano">1º ano</option>
        <option value="2ano">2º ano</option>
        <option value="3ano">3º ano</option>
    </select>
  </div>

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
      // window.location.href = /perfil-aluno.html?nome=${encodeURIComponent(nome)};
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
   
@endsection