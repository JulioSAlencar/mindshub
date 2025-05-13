@extends('layouts.app')

@section('title', $discipline->title)

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

<div x-data="{ tab: 'missoes' }">
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
    
      <a href="{{ route('certificates.generate', $discipline->id) }}" class="btn btn-primary">
          Baixar Certificado
      </a>
    @can("is-teacher")
    <div class="text-right mb-4">
        <a href="{{ route('contents.createForm', ['id' => $discipline->id]) }}" x-show="tab === 'conteudo'" 
          class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
            Adicionar Conteúdo
        </a>
        <a href="{{ route('contents.editContents', $discipline->id) }}" x-show="tab === 'conteudo'" 
          class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
            Editar Conteúdo
        </a>
        <a href="{{ route('missions.create', $discipline->id) }}" x-show="tab === 'missoes'" 
          class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
            Criar Missão
        </a>
        <a href="{{ route('missions.index', $discipline->id) }}" x-show="tab === 'missoes'" 
          class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
            Ver Missões
        </a>
        <a href="{{ route('disciplines.edit', $discipline->id) }}">
          <button x-show="" 
                  class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
                  Configurações da Disciplina
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
    @foreach ($discipline->contents as $content)
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
          <div class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/prancheta.svg') }}" alt="icone" class="w-10 h-10">
              <div>
                  <p class="text-lg font-medium mb-2">{{ $content->title }}</p>
                  <p class="text-sm text-gray-400">
                      Publicado em {{ $content->created_at->format('d/m/y') }} - {{ strtoupper($content->file_type) }} - {{ number_format($content->file_size / 1048576, 2) }} MB
                  </p>
              </div>
          </div>
          <div class="flex gap-2">
              <a href="{{ url($content->file_path) }}" target="_blank">
                  <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver</button>
              </a>
              <a href="{{ url($content->file_path) }}" download>
                  <button class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 transition">Download</button>
              </a>
          </div>
      </div>
    @endforeach
  </div>
    <!-- div mãe img -->
    <picture class="grid justify-center">
      {{-- <img src="{{ asset('assets/images/bgConteudo.png') }}" alt="imagem de ilustrativa"> --}}
    </picture>
  </div>

  <!-- Missões -->
  <div x-show="tab === 'missoes'" class="bg-gray-900 p-6 rounded-b-lg text-white grid grid-cols-2">

  <!-- div mãe items -->
  <div class="w-3/4 flex flex-col gap-6 justify-center">
    @foreach ($missions as $mission)
      <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
        <div class="flex items-center gap-3">
          <img src="{{ asset('assets/icons/grafico.svg') }}" alt="icone">
          <div>
            <p class="text-lg font-medium mb-2">{{ $mission->title }}</p>
            <p class="text-sm text-gray-400">
              Quantidade de questões: {{ $mission->questions->count() }}<br>
              Publicado em {{ $mission->created_at->format('d/m/y') }}
            </p>
          </div>
        </div>
        {{-- Botões de ação --}}
        <div class="flex items-center gap-2">
          @can("is-student")
            @if (in_array($mission->id, $answeredMissionIds))
              <a href="{{ route('missions.result', $mission->id) }}" class="inline-block bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition font-medium">
                Ver meu resultado
              </a>
            @else
              @if (!(Auth::user()->role === 'teacher' && $mission->discipline->user_id === Auth::id()))
                <a href="{{ route('missions.show', $mission->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition font-medium">
                  Responder
                </a>
              @endif
            @endif
          @endcan

          @can("is-teacher")
            <a href="{{ route('missions.responses', $mission->id) }}" class="btn btn-primary">
              Ver respostas dos alunos
            </a>
          @endcan
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection