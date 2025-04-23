@extends('layouts.app')

@section('content')
<section class="p-6">
  <div class="mb-6">
    <p class="text-sm text-gray-500">Termos de Uso</p>
    <h1 class="text-3xl font-bold text-gray-900">Termos e Condições<span class="text-indigo-600">.</span></h1>
  </div>

  <div class="space-y-6 text-gray-800 text-sm leading-relaxed">

    <div class="topico">
      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">1. Aceitação dos Termos</h2>
      </div>
      <div class="topico-filho hidden ml-6">
        <p>1.1 Ao acessar e utilizar a plataforma Mindshub, você concorda com os presentes Termos e Condições. Se não concordar, recomendamos que não utilize nossos serviços.</p>
      </div>
    </div>

    <div class="topico">
      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">2. Descrição da Plataforma</h2>
      </div>
      <div class="topico-filho hidden ml-6 space-y-2">
        <p>2.1 O Mindshub é uma plataforma de ensino gamificada que oferece cursos, desafios e atividades interativas com o objetivo de promover aprendizado contínuo e envolvente.</p>
        <p>2.2 Os usuários acumulam pontos, medalhas e níveis à medida que completam lições e desafios, incentivando a progressão no aprendizado.</p>
      </div>
    </div>

    <div class="topico">

      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">3. Cadastro e Conta</h2>
      </div>

      <div class="topico-filho hidden ml-6 space-y-2">
        <p>3.1 Para utilizar os recursos da plataforma, o usuário deve criar uma conta informando dados válidos e atualizados.</p>
        <p>3.2 O usuário é responsável por manter a confidencialidade de sua senha e por todas as atividades realizadas em sua conta.</p>
        <p>3.3 Nos reservamos o direito de suspender ou excluir contas que violem estes termos ou apresentem comportamento inadequado.</p>
      </div>

    </div>

    <div class="topico">

      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">4. Propriedade Intelectual</h2>
      </div>

      <div class="topico-filho hidden ml-6 space-y-2">
        <p>4.1 Todo o conteúdo presente na plataforma, incluindo textos, vídeos, imagens, logotipos, gráficos e elementos de gamificação, é de propriedade do Mindshub ou de seus parceiros e está protegido pelas leis de direitos autorais.</p>
        <p>4.2 É proibido copiar, reproduzir ou distribuir qualquer conteúdo da plataforma sem autorização prévia por escrito.</p>
      </div>

    </div>


    <div class="topico">

      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">5. Uso Aceitável</h2>
      </div>

      <div class="topico-filho hidden ml-6 space-y-2">
        <p>5.1 O usuário concorda em utilizar a plataforma apenas para fins educacionais, não sendo permitido o uso indevido, como disseminação de conteúdo ofensivo, spam, ou tentativa de engenharia reversa do sistema.</p>
      </div>

    </div>

    <div class="topico">

      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">6. Planos e Pagamentos</h2>
      </div>

      <div class="topico-filho hidden ml-6 space-y-2">
        <p>6.1 A Mindshub oferece planos gratuitos e pagos. Os detalhes de cada plano estão disponíveis na área de assinatura do site.</p>
        <p>6.2 Em caso de cancelamento de plano pago, o acesso premium será mantido até o final do período já pago, sem reembolsos parciais.</p>
      </div>

    </div>

    <div class="topico">

      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">7. Modificações nos Termos</h2>
      </div>

      <div class="topico-filho hidden ml-6 space-y-2">
        <p>7.1 Podemos alterar estes Termos a qualquer momento. Os usuários serão notificados por e-mail ou através da própria plataforma, e o uso contínuo da plataforma será considerado aceitação das alterações.</p>
      </div>

    </div>


    <div class="topico">

      <div class="topico-pai cursor-pointer flex items-center gap-2" onclick="toggleFilhos(this)">
        <i class="seta fa fa-chevron-down transition-transform"></i>
        <h2 class="text-xl font-semibold text-gray-900">8. Contato</h2>
      </div>

      <div class="topico-filho hidden ml-6 space-y-2">
        <p>8.1 Em caso de dúvidas, sugestões ou problemas, entre em contato conosco pelo e-mail <a class="text-indigo-600 hover:underline" href="mailto:contato@mindshub.com">contato@mindshub.com</a>.</p>
      </div>

    </div>

  </div>
</section>
@endsection