@extends('layouts.app')

@section('title', $discipline->title)

@section('content')

{{-- Alerta de sucesso --}}
@if(session('msg'))
  <div class="flex items-center gap-2 p-4 mb-6 text-green-800 bg-green-100 border border-green-400 rounded-lg shadow-sm" role="alert">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd"/>
    </svg>
    <span>{{ session('msg') }}</span>
  </div>
@endif

{{-- Alerta de erro --}}
@if(session('error'))
  <div class="flex items-center gap-2 p-4 mb-6 text-red-800 bg-red-100 border border-red-400 rounded-lg shadow-sm" role="alert">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M18 10A8 8 0 11.001 10 8 8 0 0118 10zM9 4a1 1 0 012 0v4a1 1 0 01-2 0V4zm1 8a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" clip-rule="evenodd"/>
    </svg>
    <span>{{ session('error') }}</span>
  </div>
@endif

{{-- Container principal --}}
<div x-data="{ tab: 'missoes' }">
  <header class="flex flex-col lg:flex-row items-center justify-between gap-8 px-8 py-10 bg-white shadow rounded-lg mb-10">
    <div class="flex items-center gap-8">
      <figure class="flex-shrink-0">
        <img src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image) : asset('assets/disciplines/defalt_discipline.png') }}"
             alt="{{ $discipline->title }}"
             class="w-40 h-40 object-cover rounded-xl shadow-md">
      </figure>
      <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $discipline->title }}</h1>
        <div class="flex items-center gap-3">
          <img src="{{ asset($disciplineOwner['profile_photo'] ?? 'assets/profile_photos/default.png') }}"
               alt="Foto do professor"
               class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
          <p class="text-xl font-medium text-gray-700">Prof. {{ $disciplineOwner['name'] }}</p>
        </div>
      </div>
    </div>

    <div class="flex flex-col gap-3">
      @if ($discipline->is_completed)
        <a href="{{ route('certificates.generate', $discipline->id) }}"
           class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition shadow">
          Baixar Certificado
        </a>
      @endif

      @cannot('is-creator', $discipline)
        @if ($discipline->is_completed)
          <a href="{{ route('certificates.generate', $discipline->id) }}"
            class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition shadow">
            Baixar Certificado
          </a>
        @endif
      @endcannot
    
    </div>
    <div class="flex flex-col gap-3">
      @can('is-student-or-teacher')
        @cannot('is-creator', $discipline)
          <form action="{{ route('disciplines.leave', $discipline->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="openModal()" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition shadow">
              Sair da disciplina
            </button>
          </form>
        @endcannot
      @endcan
    </div>
  </header>

  {{-- Abas de navegação --}}
  <nav class="flex rounded-t-lg overflow-hidden text-center bg-gray-700 text-white font-semibold shadow-md">
    <button @click="tab = 'conteudo'"
            :class="tab === 'conteudo' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-800'"
            class="w-1/2 px-4 py-3 transition">
      Conteúdo
    </button>
    <button @click="tab = 'missoes'"
            :class="tab === 'missoes' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-800'"
            class="w-1/2 px-4 py-3 transition">
      Missões
    </button>
  </nav>

  {{-- Seção Conteúdo --}}
  <section x-show="tab === 'conteudo'" class="bg-gray-900 text-white px-8 py-10 rounded-b-lg grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="space-y-8">
      @foreach ($groupedContents as $category => $contents)
        <div>
          <h2 class="text-2xl font-semibold mb-4 capitalize">{{ $category }}</h2>
          @foreach ($contents as $content)
            <div class="bg-gray-700 p-4 rounded-lg shadow flex justify-between items-center gap-4">
              <div class="flex items-center gap-4">
                <img src="{{ asset('assets/icons/prancheta.svg') }}" alt="" class="w-10 h-10">
                <div>
                  <h3 class="text-lg font-semibold">{{ $content->title }}</h3>
                  <p class="text-sm text-gray-400">
                    {{ $content->created_at->format('d/m/y') }} —
                    {{ strtoupper($content->file_type) }} •
                    @if($content->file_size >= 1048576)
                      {{ number_format($content->file_size / 1048576, 2) }} MB
                    @else
                      {{ number_format($content->file_size / 1024, 2) }} KB
                    @endif
                  </p>
                </div>
              </div>
              <div class="flex gap-2">
                <a href="{{ url($content->file_path) }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">Ver</a>
                <a href="{{ url($content->file_path) }}" download class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">Download</a>
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
    <figure class="flex justify-center items-center">
      <img src="{{ asset('assets/images/bgConteudo.png') }}" alt="Ilustração" class="rounded-lg max-w-full">
    </figure>
  </section>

  {{-- Seção Missões --}}
  <section x-show="tab === 'missoes'" class="bg-gray-900 text-white px-8 py-10 rounded-b-lg grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="space-y-6">
      @foreach ($missions as $mission)
        <div class="bg-gray-700 p-4 rounded-lg shadow flex justify-between items-center gap-4">
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/icons/grafico.svg') }}" alt="" class="w-10 h-10">
            <div>
              <h3 class="text-lg font-semibold">{{ $mission->title }}</h3>
              <p class="text-sm text-gray-400">
                Questões: {{ $mission->questions->count() }}<br>
                Início: {{ $mission->start_date->format('d/m/Y') }}<br>
                Término: {{ $mission->end_date->format('d/m/Y') }}
              </p>
            </div>
          </div>
          <div class="flex flex-wrap gap-2 justify-end">
            @can("is-student-or-teacher")
              @if ($mission->discipline->creator_id !== Auth::id())
                @if ($mission->end_date < now())
                  <a href="{{ route('missions.result', $mission->id) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                    Ver meu resultado
                  </a>
                @elseif (in_array($mission->id, $answeredMissionIds))
                  <a href="{{ route('missions.result', $mission->id) }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                    Ver meu resultado
                  </a>
                @else
                  {{-- Missão ainda válida e não respondida --}}
                  <a href="{{ route('missions.show', $mission->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition font-medium">
                    Responder
                  </a>
                @endif
              @endif
            @endcan
            @can('is-creator', $mission->discipline)
              <a href="{{ route('missions.responses', $mission->id) }}"
                 class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                Ver respostas
              </a>
            @endcan
          </div>
        </div>
      @endforeach
    </div>
    <figure class="flex justify-center items-center">
      <img src="{{ asset('assets/images/BglogoMiss.png') }}" alt="Ilustração" class="rounded-lg max-w-full">
    </figure>
  </section>
</div>
<!-- Modal de confirmação -->
<div id="leaveModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tem certeza?</h2>
    <p class="text-gray-600 mb-6">
      Você está prestes a se desinscrever da disciplina. <strong>Todo o seu progresso será apagado.</strong>
    </p>
    <div class="flex justify-end gap-4">
      <button onclick="closeModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
        Cancelar
      </button>
      <form id="leaveForm" action="{{ route('disciplines.leave', $discipline->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
          Confirmar saída
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('leaveModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('leaveModal').classList.add('hidden');
  }
</script>

@endsection
