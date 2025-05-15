<footer class="bg-slate-900 w-full p-8 text-white">
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 justify-items-center">

    <!-- Logo -->
    <div class="flex items-center justify-center sm:justify-start">
      <img src="{{ asset('assets/images/logoFooter.png') }}" alt="Logo MindsHub" class="h-16 w-auto" />
    </div>

    <!-- Navegação -->
    <nav aria-label="Navegação" class="w-full max-w-xs">
      <h2 class="text-xl font-semibold mb-4 relative inline-block">
        Navegação
        <span class="absolute left-0 bottom-0 w-full h-1 rounded bg-blue-500"></span>
      </h2>
      <ul class="space-y-3">
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            DashBoard
          </a>
        </li>
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Disciplinas
          </a>
        </li>
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Configurações
          </a>
        </li>
      </ul>
    </nav>

    <!-- Créditos & Parceiros -->
    <section aria-label="Créditos e Parceiros" class="w-full max-w-xs">
      <h2 class="text-xl font-semibold mb-4 relative inline-block">
        Créditos & Parceiros
        <span class="absolute left-0 bottom-0 w-full h-1 rounded bg-blue-500"></span>
      </h2>
      <ul class="space-y-3">
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Desenvolvido por The dry liter
          </a>
        </li>
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Programadores
          </a>
        </li>
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Gestão de Projeto
          </a>
        </li>
      </ul>
    </section>

    <!-- Suporte e Contato -->
    <section aria-label="Suporte e Contato" class="w-full max-w-xs">
      <h2 class="text-xl font-semibold mb-4 relative inline-block">
        Suporte e Contato
        <span class="absolute left-0 bottom-0 w-full h-1 rounded bg-blue-500"></span>
      </h2>
      <ul class="space-y-3">
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            FAQ
          </a>
        </li>
        <li>
          <a href="{{ route('termos') }}" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Termos de Uso
          </a>
        </li>
        <li>
          <a href="#" class="block transition transform hover:text-blue-500 hover:translate-x-2 hover:underline decoration-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            Política de Privacidade
          </a>
        </li>
        <li>
          <a href="mailto:suporte@mindshub.com" class="block text-blue-500 transition transform hover:text-blue-400 hover:translate-x-2 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
            suporte@mindshub.com
          </a>
        </li>
      </ul>
    </section>
  </div>

  <div class="max-w-7xl mx-auto mt-10 border-t border-slate-700 pt-4 text-right text-sm text-slate-400">
    <p>MindsHub © Alguns direitos reservados. 2025</p>
  </div>
</footer>
