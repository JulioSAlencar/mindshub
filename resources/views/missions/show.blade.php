@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="max-w-2xl mx-auto bg-gray-800 rounded-lg shadow-md p-6 text-white">

        <h1 class="text-3xl font-bold mb-4">Missão: {{ $mission->title }}</h1>
        <p class="text-sm text-gray-300 mb-1">Questão {{ $currentIndex + 1 }} de {{ $questions->count() }}</p>
        <p class="text-sm text-gray-300 mb-4">Tempo estimado: {{ $mission->duration_minutes }} minutos</p>

        <hr class="border-gray-600 my-4">

        <div class="mb-6">
            <p class="text-lg font-semibold mb-3">{{ $currentQuestion->statement }}</p>
        </div>

        <form method="POST" action="{{ route('missions.submit', ['mission' => $mission->id, 'index' => $currentIndex]) }}">
            @csrf

            <div class="space-y-4 mb-6">
                @php
                    $wrongAnswers = json_decode($currentQuestion->wrong_answers, true) ?? [];
                    $options = array_merge([$currentQuestion->correct_answer], $wrongAnswers);
                    shuffle($options);
                @endphp

                @foreach ($options as $index => $option)
                    <label class="flex items-center bg-gray-700 p-4 rounded-lg hover:bg-gray-600 transition cursor-pointer">
                        <input type="radio" name="answer" value="{{ $option }}" class="mr-4 accent-blue-500" required>
                        <span class="text-base">{{ $option }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                Enviar Resposta e Próxima
            </button>
        </form>
    </div>
</div>
@endsection
