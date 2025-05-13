@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-gray-700 rounded-lg shadow-md p-8 text-center">

        <h1 class="text-3xl font-bold mb-4 text-green-400">Missão Concluída!</h1>

        @if (session('success'))
            <p class="text-lg mb-6 text-gray-200">{{ session('success') }}</p>
        @else
            <p class="text-lg mb-6 text-gray-200">Você respondeu todas as questões desta missão.</p>
        @endif

        {{-- Botão para ver resultado da missão específica --}}
        @if($mission)
            <a href="{{ route('missions.result', $mission->id) }}" class="inline-block bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition font-medium mb-4">
                Ver meu resultado
            </a>
            <br> {{-- Quebra de linha para separar os botões --}}
        @else
            {{-- Este bloco é menos provável de ser atingido agora --}}
            <p class="text-red-400">Não foi possível encontrar os detalhes da missão.</p>
        @endif


        {{-- Botão para voltar para a disciplina relacionada --}}
        {{-- CORRIGIDO: usar $discipline->id consistentemente --}}
        <a href="{{ route('disciplines.showContent', $discipline->id) }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition font-medium">
            Voltar para {{ $discipline->name ?? 'Disciplina' }}
        </a>

    </div>
@endsection