@extends('layouts.app')

@section('content')

@if(session('msg'))
  <div class="alert alert-success">
      {{ session('msg') }}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif
<div class="flex items-center justify-between p-8">
  <div class="flex items-center">
    <picture>
      <img src="{{ asset('assets/disciplines/fotoMatematica.png') }}" alt="Imagem de Matemática">
    </picture>
    <div class="ml-11">
      <h1 class="text-4xl mb-8">Matemática</h1>
      <div class="flex items-center">
        <img src="{{ asset('assets/disciplines/fotoUsuario.svg') }}" alt="Imagem de Matemática">
        <p class="text-2xl">Prof. Julho Matheus; 2º ano B, 27 matérias.</p>
      </div>
    </div>
  </div>

  {{-- Mostrar este botão apenas se o usuário logado for um professor --}}
  <button class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">Adicionar Conteúdo</button>

</div>

<!-- Aqui começam as abas -->
<div x-data="{ tab: 'missoes' }" class="px-8 pb-10">
  <!-- Tabs -->
  <div class="flex bg-gray-700 rounded-t-lg overflow-hidden">
    <button
      class="w-1/2 py-3 text-center font-semibold transition-all"
      :class="tab === 'conteudo' ? 'bg-gray-900 text-white text-lg' : 'text-gray-300'"
      @click="tab = 'conteudo'">
      Conteúdo
    </button>
    <button
      class="w-1/2 py-3 text-center font-semibold transition-all"
      :class="tab === 'missoes' ? 'bg-gray-900 text-white text-lg' : 'text-gray-300'"
      @click="tab = 'missoes'">
      Missões
    </button>
  </div>

  <!-- Conteúdo -->
  <div x-show="tab === 'conteudo'" class="bg-gray-900 p-6 rounded-b-lg text-white grid grid-cols-2">

    <!-- div mãe items -->
    <div class="w-3/4 flex flex-col gap-6 justify-center">

      <!-- item 1 -->
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 w-">
          <img src="{{ asset('assets/icons/prancheta.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">Funções Quadraticas - Apostila</p>
            <p class="text-sm text-gray-400">Publicado em 23/03/25 - PDF - 3.2 MB</p>
          </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver</button>
      </div>

      <!-- item 2 -->
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 w-">
          <img src="{{ asset('assets/icons/prancheta.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">Funções Quadraticas - Apostila</p>
            <p class="text-sm text-gray-400">Publicado em 23/03/25 - PDF - 3.2 MB</p>
          </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver</button>
      </div>

      <!-- item 3 -->
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 w-">
          <img src="{{ asset('assets/icons/prancheta.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">Funções Quadraticas - Apostila</p>
            <p class="text-sm text-gray-400">Publicado em 23/03/25 - PDF - 3.2 MB</p>
          </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver</button>
      </div>

    </div>

    <!-- div mãe img -->
    <picture class="grid justify-center">
      <img src="{{ asset('assets/images/bgConteudo.png') }}" alt="imagem de ilustrativa">
    </picture>
  </div>

  <!-- Missões -->
  <div x-show="tab === 'missoes'" class="bg-gray-900 p-6 rounded-b-lg text-white grid grid-cols-2">

    <!-- div mãe items -->
    <div class="w-3/4 flex flex-col gap-6 justify-center">

      <!-- item 1 -->
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 w-">
          <img src="{{ asset('assets/icons/grafico.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">Funções Quadraticas - Apostila</p>
            <p class="text-sm text-gray-400">Publicado em 23/03/25 - PDF - 3.2 MB</p>
          </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver resposta</button>
      </div>

      <!-- item 2 -->
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 w-">
          <img src="{{ asset('assets/icons/grafico.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">Funções Quadraticas - Apostila</p>
            <p class="text-sm text-gray-400">Publicado em 23/03/25 - PDF - 3.2 MB</p>
          </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver resposta</button>
      </div>

      <!-- item 3 -->
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 w-">
          <img src="{{ asset('assets/icons/grafico.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">Funções Quadraticas - Apostila</p>
            <p class="text-sm text-gray-400">Publicado em 23/03/25 - PDF - 3.2 MB</p>
          </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver resposta</button>
      </div>

    </div>

    <!-- div mãe img -->
    <picture class="grid justify-center">
      <img src="{{ asset('assets/images/bgConteudo.png') }}" alt="imagem de ilustrativa">
    </picture>
  </div>

</div>

@endsection