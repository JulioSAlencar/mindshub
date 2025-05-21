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
  <header class="flex items-center justify-between p-8">
    <div class="flex items-center">
      <figure>
        <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}"
              class="w-48 h-48 object-cover rounded-lg">
      </figure>
      <div class="ml-11">
        <h1 class="text-4xl mb-8">{{ $discipline->title }}</h1>
        <div class="flex items-center">
          @if (!empty($disciplineOwner['profile_photo']))
              <img src="{{ asset($disciplineOwner['profile_photo']) }}" alt="Imagem do professor"  
                   class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
          @else
              <img src="{{ asset('assets/profile_photos/default.png') }}" alt="Imagem padrão" 
                   class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
          @endif
          <p class="text-2xl ml-2">Prof. {{ $disciplineOwner['name'] }}</p>
        </div>
      </div>
    </div>
    <div class="space-y-2">
    
      <button href="{{ route('certificates.generate', $discipline->id) }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
          Baixar Certificado
      </button>
      <a href="{{ route('disciplines.manager', ['id' => $discipline->id])}}" class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
        Gerenciar disicplina
      </a>
    </div>
    
  </header>

  <div class="px-8 pb-10">
    <!-- Navegação por abas -->
    <nav class="flex bg-gray-700 rounded-t-lg overflow-hidden">
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
    </nav>

    <!-- Seção de Conteúdo -->
    <section id="conteudo" x-show="tab === 'conteudo'" class="bg-gray-900 p-6 rounded-b-lg text-white grid grid-cols-2">
      <div class="w-3/4 flex flex-col gap-6 justify-center">
        @foreach ($groupedContents as $category => $contents)
          <article>
            <h2 class="text-2xl font-bold text-white mb-4 capitalize">
                {{ $category }}
            </h2>

            @foreach ($contents as $content)
              <div class="bg-gray-600 rounded-md p-2 flex justify-between items-center mb-3">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/icons/prancheta.svg') }}" alt="ícone de conteúdo" class="w-10 h-10">
                    <div>
                        <h3 class="text-lg font-medium mb-2">{{ $content->title }}</h3>
                        <p class="text-sm text-gray-400">
                            Publicado em {{ $content->created_at->format('d/m/y') }}
                            {{ strtoupper($content->file_type) }} -
                            @if($content->file_size >= 1048576)
                                {{ number_format($content->file_size / 1048576, 2) }} MB
                            @else
                                {{ number_format($content->file_size / 1024, 2) }} KB
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ url($content->file_path) }}" target="_blank" rel="noopener noreferrer">
                        <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Ver</button>
                    </a>
                    <a href="{{ url($content->file_path) }}" download>
                        <button class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 transition">Download</button>
                    </a>
                </div>
              </div>
            @endforeach
          </article>
        @endforeach
      </div>
      <figure class="grid justify-center">
        <!-- Imagem ilustrativa (mantido como placeholder) -->
      </figure>
    </section>

    <!-- Seção de Missões -->
    <section id="missoes" x-show="tab === 'missoes'" class="bg-gray-900 p-6 rounded-b-lg text-white grid grid-cols-2">
      <div class="w-3/4 flex flex-col gap-6 justify-center">
        @foreach ($missions as $mission)
          <article class="bg-gray-600 rounded-md p-2 flex justify-between items-center">
            <div class="flex items-center gap-3">
              <img src="{{ asset('assets/icons/grafico.svg') }}" alt="ícone de missão" class="w-10 h-10">
              <div>
                <h3 class="text-lg font-medium mb-2">{{ $mission->title }}</h3>
                <p class="text-sm text-gray-400">
                  Quantidade de questões: {{ $mission->questions->count() }}<br>
                  Publicado em {{ $mission->created_at->format('d/m/y') }}
                </p>
              </div>
            </div>
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
          </article>
        @endforeach
      </div>
    </section>
  </div>
</div>

@endsection