@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        <i class="fas fa-poll"></i> Respostas da Missão: <span class="text-blue-600">{{ $mission->title }}</span>
    </h2>

    @php
    $totalScores = 0;
    $studentCount = count($responses);

    foreach($responses as $userId => $answers) {
    $correct = $answers->where('is_correct', true)->count();
    $total = $answers->count();
    $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
    $totalScores += $score;
    }

    $averageScore = $studentCount > 0 ? round($totalScores / $studentCount, 2) : 0;

    $acimaOuNaMedia = [];
    $abaixoDaMedia = [];

    foreach($responses as $userId => $answers) {
    $user = $answers->first()->user;
    $correct = $answers->where('is_correct', true)->count();
    $total = $answers->count();
    $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

    $aluno = [
    'user' => $user,
    'score' => $score,
    'answers' => $answers
    ];

    if ($score >= $averageScore) {
    $acimaOuNaMedia[] = $aluno;
    } else {
    $abaixoDaMedia[] = $aluno;
    }
    }
    @endphp

    <div class="bg-white border border-blue-200 rounded-xl shadow p-6 mb-8 flex flex-col items-center">
        <h4 class="text-2xl font-bold text-gray-700 mb-4">
            🎯 Média da Turma: <span class="text-blue-600">{{ $averageScore }}%</span>
        </h4>

        <div class="w-64 h-64">
            <canvas id="averageChart"></canvas>
        </div>

        <p class="text-sm text-gray-500 mt-4">
            Desempenho baseado nas respostas de todos os alunos.
        </p>
    </div>

    <!-- Alunos Acima da Média -->
    <h3 class="text-2xl font-bold text-green-600 flex items-center gap-2">
        <i class="fas fa-arrow-up"></i> Alunos na média ou acima
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        @foreach($acimaOuNaMedia as $aluno)
        <div class="bg-white border border-green-300 rounded-lg shadow p-4">
            <h5 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-user"></i> {{ $aluno['user']->name }}
            </h5>
            <p class="text-green-700 font-medium">Nota: {{ $aluno['score'] }}%</p>
        </div>
        @endforeach
    </div>

    <!-- Alunos Abaixo da Média -->
    <h3 class="text-2xl font-bold text-red-600 mt-8 flex items-center gap-2">
        <i class="fas fa-arrow-down"></i> Alunos abaixo da média
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        @foreach($abaixoDaMedia as $aluno)
        <div class="bg-white border border-red-300 rounded-lg shadow p-4">
            <h5 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-user"></i> {{ $aluno['user']->name }}
            </h5>
            <p class="text-red-700 font-medium">Nota: {{ $aluno['score'] }}%</p>
        </div>
        @endforeach
    </div>

    <!-- Detalhes de Respostas -->
    <h2 class="text-3xl font-bold text-gray-800 mt-10 mb-6">
        <i class="fas fa-clipboard-check"></i> Respostas por aluno
    </h2>

    <div class="space-y-6">
        @foreach($responses as $userId => $answers)
        @php
        $user = $answers->first()->user;
        $correct = $answers->where('is_correct', true)->count();
        $total = $answers->count();
        $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        @endphp

        <div class="bg-white border border-gray-200 rounded-lg shadow p-5">
            <h5 class="text-xl font-semibold text-gray-800 mb-3">
                <i class="fas fa-user-graduate"></i> {{ $user->name }} -
                <span class="text-blue-600">Nota: {{ $score }}%</span>
            </h5>

            <ul class="space-y-2">
                @foreach($answers as $answer)
                <li class="border-b pb-2">
                    <strong class="text-gray-700">{{ $answer->question->text }}</strong><br>
                    Resposta: <span class="font-medium">{{ $answer->selected_answer }}</span> -
                    <span class="{{ $answer->is_correct ? 'text-green-600' : 'text-red-600' }}">
                        {{ $answer->is_correct ? '✅ Correta' : '❌ Incorreta' }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>

</div>

<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('averageChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Acertos (%)', 'Erros (%)'],
            datasets: [{
                data: [{{ $averageScore }}, {{ 100 - $averageScore }}],
                backgroundColor: ['#36a2eb', '#ff6384'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                title: {
                    display: true,
                    text: 'Desempenho Médio da Turma'
                }
            }
        }
    });
</script>

@endsection