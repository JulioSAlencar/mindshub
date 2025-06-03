@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F6F7F9] px-6 py-8">
    {{-- Cabeçalho --}}
    <div class="flex items-center gap-2 mb-8">
        <i class="fas fa-flag text-blue-600 text-3xl"></i>
        <h1 class="text-3xl font-semibold text-gray-900">Trilhas</h1>
    </div>

    {{-- Cards das Trilhas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($disciplines as $discipline)
        <div class="bg-[#0D162B] rounded-2xl shadow-lg">
            
            {{-- Nível --}}
            <div class="flex justify-start p-4">
                @if($discipline->level === 'básico')
                    <span class="bg-green-500 text-white text-xs font-semibold px-4 py-[2px] rounded-full">Básico</span>
                @elseif($discipline->level === 'intermediário')
                    <span class="bg-yellow-400 text-black text-xs font-semibold px-4 py-[2px] rounded-full">Intermediário</span>
                @elseif($discipline->level === 'avançado')
                    <span class="bg-red-600 text-white text-xs font-semibold px-4 py-[2px] rounded-full">Avançado</span>
                @endif
            </div>

            {{-- Conteúdo --}}
            <div class="bg-[#1B2438] p-6 rounded-b-2xl">
                <h3 class="text-gray-200 text-sm mb-3">Trilha: <span class="font-medium">{{ $discipline->title }}</span></h3>

                {{-- Matéria e XP --}}
                <div class="flex justify-between items-center text-xs text-gray-300 mb-1">
                    <span>matéria</span>
                    <span>{{ $discipline->xp ?? 0 }}xp</span>
                </div>

                {{-- Barra de progresso --}}
                <div class="w-full h-2 bg-gray-300 rounded-full mb-4">
                    <div class="h-2 bg-blue-600 rounded-full" style="width: {{ $discipline->progress }}%;"></div>
                </div>

                {{-- Missões e Progresso --}}
                <div class="flex justify-between text-xs text-gray-400 mb-4">
                    <span>{{ $discipline->missions_completed ?? 0 }}/{{ $discipline->missions->count() }} missões</span>
                    <span>{{ $discipline->progress }}% concluído</span>
                </div>

                {{-- Status --}}
                <div class="flex items-center gap-2 text-gray-400 text-xs mb-6">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span>
                        @if($discipline->status === 'em_andamento')
                            Em andamento - Restam {{ $discipline->dias_restantes ?? 0 }} dias
                        @else
                            Restam {{ $discipline->dias_restantes ?? 0 }} dias
                        @endif
                    </span>
                </div>

                {{-- Botão --}}
                <a href="{{ route('disciplines.showContent', $discipline->id) }}" 
                   class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                    CONTINUAR
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
