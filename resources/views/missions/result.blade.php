@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Resultado da Missão: {{ $mission->title }}</h2>
    <p><strong>Acertos:</strong> {{ $correctAnswers }} de {{ $totalQuestions }}</p>
    <p><strong>Nota:</strong> {{ $score }}%</p>

    <hr>

    <h4>Respostas</h4>
    <ul>
        @foreach($answers as $answer)
            <li>
                <strong>Pergunta:</strong> {{ $answer->question->text }} <br>
                <strong>Sua resposta:</strong> {{ $answer->selected_answer }} <br>
                <strong>Correta?</strong> {{ $answer->is_correct ? 'Sim ✅' : 'Não ❌' }}
            </li>
            <hr>
        @endforeach
    </ul>
</div>
@endsection
