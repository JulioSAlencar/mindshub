@extends('layouts.app')

@section('content')

@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow transition-opacity duration-500"
    >
        <strong>Sucesso!</strong> {{ session('success') }}
    </div>
@endif

<div class="max-w-6xl mx-auto px-4 py-8">

    <div class="mb-6">
        <a href="{{ route('disciplines.showContent', $discipline->id) }}">
            <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                ← Voltar
            </button>
        </a>
    </div>

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Missões</h1>
        <a href="{{ route('missions.create', $discipline->id) }}"
           class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition shadow">
            Criar Missão para {{ $discipline->title }}
        </a>
    </div>

    <div class="grid gap-6">
        @foreach($missions as $mission)
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">{{ $mission->title }}</h3>
                    <p class="text-gray-500 mt-1">
                        {{ $mission->questions_count }} questões • 
                        {{ \Carbon\Carbon::parse($mission->start_date)->format('d/m/Y') }} - 
                        {{ \Carbon\Carbon::parse($mission->end_date)->format('d/m/Y') }}
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @can("is-teacher")
                    <a href="{{ route('missions.responses', $mission->id) }}"
                       class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition text-sm">
                        Ver respostas dos alunos
                    </a>
                    <a href="{{ route('questions.edit', $mission->id )}}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition text-sm">
                        Editar Questões
                    </a>
                    <form action="{{ route('missions.destroy', $mission->id) }}" method="POST"
                          onsubmit="return confirm('Tem certeza que deseja excluir esta missão?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition text-sm">
                            Excluir
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
