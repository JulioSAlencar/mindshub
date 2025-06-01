@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Resultado da Missão: 
        <span class="text-indigo-600">{{ $mission->title }}</span>
    </h2>

    <div class="mb-6">
        <p class="text-lg text-gray-700">
            <strong class="font-semibold text-gray-800">Acertos:</strong> 
            {{ $correctAnswers }} de {{ $totalQuestions }}
        </p>
        <p class="text-lg text-gray-700">
            <strong class="font-semibold text-gray-800">Nota:</strong> 
            {{ $score }}%
        </p>
    </div>

    <hr class="my-6 border-gray-300">

    <h4 class="text-xl font-semibold mb-4 text-gray-800">Respostas</h4>

    <ul class="space-y-6">
        @foreach($answers as $answer)
            <li class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                <p class="mb-2">
                    <strong class="text-gray-800">Pergunta:</strong> 
                    {{ $answer->question->statement }}
                </p>
                <p class="mb-2">
                    <strong class="text-gray-800">Sua resposta:</strong> 
                    {{ $answer->selected_answer }}
                </p>
                <p>
                    <strong class="text-gray-800">Correta?</strong> 
                    <span class="{{ $answer->is_correct ? 'text-green-600' : 'text-red-600' }}">
                        {{ $answer->is_correct ? 'Sim ✅' : 'Não ❌' }}
                    </span>
                </p>
            </li>
        @endforeach
    </ul>
</div>
@endsection
