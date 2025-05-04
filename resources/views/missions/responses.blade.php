@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Respostas da Missão: {{ $mission->title }}</h2>
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
    @endphp
    @php
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


    <h4 class="mt-4">Média da Turma: {{ $averageScore }}%</h4>
    <div>
        <canvas id="averageChart" style="max-width: 200px; max-height: 200px;"></canvas>
    </div>

    <h3 class="mt-5 text-success">✅ Alunos na média ou acima</h3>

    @foreach($acimaOuNaMedia as $aluno)
        <div class="card mt-3 border-success">
            <div class="card-body">              
                <h5>{{ $aluno['user']->name }} - Nota: {{ $aluno['score'] }}%</h5>
            </div>
        </div>
    @endforeach
    
    <h3 class="mt-5 text-danger">❌ Alunos abaixo da média</h3>
    
    @foreach($abaixoDaMedia as $aluno)
        <div class="card mt-3 border-danger">
            <div class="card-body">
                <h5>{{ $aluno['user']->name }} - Nota: {{ $aluno['score'] }}%</h5>
            </div>
        </div>
    @endforeach
    <br>
    <h2>Resposta por aluno</h2>
    @foreach($responses as $userId => $answers)
        @php
            $user = $answers->first()->user;
            $correct = $answers->where('is_correct', true)->count();
            $total = $answers->count();
            $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        @endphp

        <div class="card mt-4">
            <div class="card-body">
                <h5>{{ $user->name }} - Nota: {{ $score }}%</h5>

                <ul>
                    @foreach($answers as $answer)
                        <li>
                            <strong>{{ $answer->question->text }}</strong><br>
                            Resposta: {{ $answer->selected_answer }} -
                            {{ $answer->is_correct ? '✅' : '❌' }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>

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
