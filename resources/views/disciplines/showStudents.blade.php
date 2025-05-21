@extends('layouts.app')

@section('title', 'Gerenciador')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Alunos que estão participando de {{ $discipline->title }}</h1>

    <a href="{{ route('disciplines.manager', ['id' => $discipline->id])}}" class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
        voltar
    </a>
    <div class="bg-white shadow-md rounded p-4">
        @if ($discipline->students->isEmpty())
            <p class="text-gray-600">Nenhum aluno inscrito nesta disciplina.</p>
        @else
            <ul class="list-disc pl-6 space-y-2">
                @foreach ($discipline->students as $student)
                    <li>{{ $student->name }} ({{ $student->email }})</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
