@extends('layouts.app')

@section('title', 'Gerenciador')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Alunos que estão participando de <span class="text-blue-600">{{ $discipline->title }}</span>
    </h1>

    <a href="{{ route('disciplines.manager', ['id' => $discipline->id]) }}"
       class="inline-block bg-blue-600 text-white text-base font-semibold py-2 px-5 rounded-lg hover:bg-blue-700 transition mb-6">
        ← Voltar
    </a>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if ($discipline->students->isEmpty())
            <p class="text-gray-600 text-lg">Nenhum aluno inscrito nesta disciplina.</p>
        @else
            <ul class="space-y-4">
                @foreach ($discipline->students as $student)
                    <li class="flex items-center space-x-4">
                        <div>
                            @if ($student->profile_photo)
                                <img 
                                    src="{{ asset($student->profile_photo) }}" 
                                    alt="Foto de {{ $student->name }}"
                                    class="w-12 h-12 rounded-full object-cover border border-gray-300 shadow"
                                >
                            @else
                                <img 
                                    src="{{ asset('assets/profile_photos/default.png') }}" 
                                    alt="Imagem padrão"
                                    class="w-12 h-12 rounded-full object-cover border border-gray-300 shadow"
                                >
                            @endif
                        </div>
                        <div>
                            <p class="text-gray-900 font-medium">{{ $student->name }}</p>
                            <p class="text-gray-500 text-sm">{{ $student->email }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
