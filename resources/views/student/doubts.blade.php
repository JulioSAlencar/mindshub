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


        
        <!-- Main Content -->
      <main class="flex-1 p-6">
        <div class="flex items-center gap-2">
            <img src="imgs/circle-question-regular.svg" alt="Question" width="30">
            <h1 class="font-bold text-2xl">Mensagens e Dúvidas</h1>
          </div>
        <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto mt-5">
          <div class="flex items-center mb-6">
            <img src="imgs/question-solid.svg" alt="duvida" width="22"> 
            <h2 class="text-xl font-semibold ml-4">Nova Dúvida</h2>
          </div>

          <form class="space-y-6">
            <!-- Disciplina -->
            <div>
              <label for="disciplina" class="block text-sm font-medium text-gray-700 mb-1">Disciplina</label>
              <select id="disciplina" name="disciplina" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Selecione a disciplina</option>
                <option value="matematica">Matemática</option>
                <option value="portugues">Português</option>
                <option value="historia">História</option>
                <option value="geografia">Geografia</option>
                <option value="ciencias">Ciências</option>
                <option value="fisica">Física</option>
                <option value="quimica">Química</option>
              </select>
            </div>

            <!-- Título -->
            <div>
              <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título da Dúvida</label>
              <input type="text" id="titulo" name="titulo" placeholder="Ex: Como resolver equações de segundo grau?" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Descrição -->
            <div>
              <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição detalhada</label>
              <textarea id="descricao" name="descricao" rows="6" placeholder="Detalhe sua dúvida aqui..." class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Anexo -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Anexo</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-3 text-center">
                  <!-- Ícone centralizado acima -->
                  <div class="flex justify-center ">
                    <img src="imgs/file-solid.svg" alt="File" width="30px">
                  </div>
                  <div class="flex justify-center text-sm text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                      <span>Fazer upload de arquivo</span>
                      <input id="file-upload" name="file-upload" type="file" class="sr-only">
                    </label>
                    <p class="pl-1">ou arraste e solte</p>
                  </div>
                  <p class="text-xs text-gray-500">PNG, JPG, PDF, DOC até 10MB</p>
                </div>
              </div>
            </div>
            <!-- Tags -->
            <div>
              <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags (opcional)</label>
              <input type="text" id="tags" name="tags" placeholder="Ex: equação, álgebra, matemática" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <p class="mt-1 text-xs text-gray-500">Separe as tags por vírgula</p>
            </div>

            <!-- Receber notificações -->
            <div class="flex items-center">
              <input id="notifications" name="notifications" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="notifications" class="ml-2 block text-sm text-gray-700">Receber notificações quando esta dúvida for respondida</label>
            </div>

            <!-- Botões -->
            <div class="flex justify-end space-x-3 mt-6">
              <button type="button" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancelar
              </button>
              <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center">
                <div class="flex items-center gap-2 bg">
                <img src="imgs/file-import-solid.svg " alt="enviar" width="20px">
                Enviar Dúvida
              </button>
            </div>
            </div>
          </form>

          
      </main>
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
</body>

</html>
