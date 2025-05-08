@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="goback">
        <a href="{{ route('disciplines.showContent', $discipline->id) }}">
            <button x-show="tab === 'missoes'"
                class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
                voltar
            </button>
        </a>
    </div>
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Missões</h1>
        <a href="{{ route('missions.create', $discipline->id) }}">
            <button>Criar Missão para {{ $discipline->name }}</button>
        </a>
    </div>

    <div class="grid gap-4">
        @foreach($missions as $mission)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold">{{ $mission->title }}</h3>
                    <p class="text-gray-600">
                        {{ $mission->questions_count }} questões • 
                        {{ \Carbon\Carbon::parse($mission->start_date)->format('d/m/Y') }} - 
                        {{ \Carbon\Carbon::parse($mission->end_date)->format('d/m/Y') }}
                    </p>
                </div>
                <div class="flex gap-2">
                    @can("is-teacher")
                    <a href="{{ route('missions.responses', $mission->id) }}" class="btn btn-primary">
                      Ver respostas dos alunos
                    </a>
                    <a href="{{ route('missions.addQuestions', $mission) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Editar Questões
                    </a>
                  @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection