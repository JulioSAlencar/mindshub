@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Fundo branco, texto escuro -->
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6 text-gray-900">

        <h1 class="text-3xl font-bold mb-4">Missão: {{ $mission->title }}</h1>
        <p class="text-sm text-gray-600 mb-1">Questão {{ $currentIndex + 1 }} de {{ $questions->count() }}</p>
        <p class="text-lg font-semibold text-yellow-600">Tempo restante: <span id="timer"></span></p>

        <hr class="border-gray-300 my-4">

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
                    <label class="flex items-center bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition cursor-pointer">
                        <input type="radio" name="answer" value="{{ $option }}" class="mr-4 accent-blue-600" required>
                        <span class="text-base text-gray-900">{{ $option }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                Enviar Resposta e Próxima
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tempo total da missão em minutos
        const durationMinutes = {{ $mission->duration_minutes }};
        const durationSeconds = durationMinutes * 60;

        // Recuperar horário de início do banco (para cálculo correto)
        const startedAt = new Date("{{ optional(\App\Models\MissionUserStartTime::where('mission_id', $mission->id)->where('user_id', auth()->id())->first())->started_at }}");
        const now = new Date();
        const elapsedSeconds = Math.floor((now - startedAt) / 1000);
        let remainingSeconds = Math.max(0, durationSeconds - elapsedSeconds);

        function updateTimer() {
            const minutes = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
            const seconds = String(remainingSeconds % 60).padStart(2, '0');
            document.getElementById('timer').textContent = `${minutes}:${seconds}`;

            if (remainingSeconds > 0) {
                remainingSeconds--;
            } else {
                clearInterval(timerInterval);
                alert('Tempo esgotado!');
                window.location.href = "{{ route('missions.end', $mission->id) }}";
            }
        }

        updateTimer(); // chama imediatamente
        const timerInterval = setInterval(updateTimer, 1000);
    });
</script>
@endsection
