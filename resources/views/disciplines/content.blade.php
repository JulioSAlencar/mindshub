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

<div x-data="{ tab: 'missoes' }"> <!-- Adicionei o x-data aqui para englobar toda a seção -->
  <div class="flex items-center justify-between p-8">
    <div class="flex items-center">
      <picture>
        <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}"
              style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
      </picture>
      <div class="ml-11">
        <h1 class="text-4xl mb-8">{{ $discipline->title }}</h1>
        <div class="flex items-center">
          @if (!empty($disciplineOwner['profile_photo']))
              <img src="{{ asset($disciplineOwner['profile_photo']) }}" alt="Imagem do professor"  class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm>
          @else
              <img src="{{ asset('assets/profile_photos/default.png') }}" alt="Imagem padrão" class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
          @endif
          <p class="text-2xl">Prof. {{ $disciplineOwner['name'] }}</p>
        </div>
      </div>
    </div>

    @can("is-teacher")
    <div class="text-right mb-4">
        <button x-show="tab === 'conteudo'" 
                class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
            Adicionar Conteúdo
        </button>
        <a href="{{ route('missions.create', ['discipline' => $discipline->id]) }}">
          <button x-show="tab === 'missoes'" 
                  class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
              Adicionar Missão
          </button>
        </a>
    </div>
    @endcan
  </div>

  <!-- Aqui começam as abas -->
  <div class="px-8 pb-10">
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