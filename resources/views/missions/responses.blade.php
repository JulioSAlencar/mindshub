@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Respostas da Missão: {{ $mission->title }}</h2>

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
@endsection
