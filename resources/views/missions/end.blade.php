@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-gray-700 rounded-lg shadow-md p-8 text-center">

        <h1 class="text-3xl font-bold mb-4 text-green-400">Missão Concluída!</h1>

        @if (session('success'))
            <p class="text-lg mb-6">{{ session('success') }}</p>
        @else
            <p class="text-lg mb-6">Você respondeu todas as questões desta missão.</p>
        @endif

        {{-- TODO: Display score/results here if implemented --}}

        <a href="{{ route('missions.index', $disciplineId) }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition font-medium">
            Voltar para Missões de {{ $discipline->name ?? 'Disciplina' }}
        </a>

    </div>
@endsection
