@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="max-w-2xl mx-auto bg-gray-700 rounded-lg shadow-md p-6">

        <h1 class="text-2xl font-bold mb-2">Missão: {{ $mission->title }}</h1>
        <p class="text-sm text-gray-400 mb-4">Questão {{ $currentIndex + 1 }} de {{ $questions->count() }}</p>

        <hr class="border-gray-600 my-4">

        {{-- Display the current question --}}
        <div class="mb-6">
            <p class="text-lg font-semibold mb-3">{{ $currentQuestion->statement }}</p>
        </div>

        {{-- Form to submit the answer --}}
        {{-- The route needs the mission ID and the current question index --}}
        <form method="POST" action="{{ route('missions.submit', ['mission' => $mission->id, 'index' => $currentIndex]) }}">
            @csrf {{-- CSRF Protection Token --}}

            <div class="space-y-3 mb-6">
                @php
                    // Combine correct and wrong answers and shuffle them
                    // Decode wrong answers if they are stored as JSON
                    $wrongAnswers = json_decode($currentQuestion->wrong_answers, true) ?? []; // Handle potential JSON errors
                    $options = array_merge([$currentQuestion->correct_answer], $wrongAnswers);
                    shuffle($options); // Randomize answer order
                @endphp

                @foreach ($options as $index => $option)
                    <label class="flex items-center bg-gray-600 p-3 rounded-md hover:bg-gray-500 cursor-pointer">
                        <input type="radio" name="answer" value="{{ $option }}" class="mr-3 text-blue-500 focus:ring-blue-400" required>
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition font-medium">
                Enviar Resposta e Próxima
            </button>

        </form>

    </div>
</div>
@endsection