@extends('layouts.app')

@section('content')
<div>
    <h4>Criar nova missão</h4>
</div>

<div>
    <form action="{{ route('missions.store') }}" method="POST" id="mission-form">
        @csrf

            <!-- Statement -->
        <div>
            <h5>1/10 Questão</h5>
            <div>
                <label for="statement">Texto do enunciado</label>
                <textarea name="statement" id="statement" required
                    placeholder="Digite o enunciado da missão..."></textarea>
            </div>
        </div>

            <!-- Correct Answer and Explanation-->
        <div>
            <label for="correct_answer">Resposta certa</label>
            <input type="text" id="correct_answer" name="correct_answer" required
                placeholder="Digite a respota correta...">
        </div>

        <div>
            <label for="explanation">Explicação da resposta</label>
            <textarea name="explanation" id="explanation" required
                placeholder="Explique por que a resposta é a correta..."></textarea>
        </div>

            <!-- Wrong Answers -->
        <div>
            <label>Resposta errada</label>
            @for($i = 0; $i < 3; $i++)
            <div>
                <input type="text" name="wrong_answers[]" required
                    placeholder="Resposta errada {{ $i+1 }}">
                @if($i >= 3)
                    <button type="button">
                        <i></i>
                    </button>
                @endif
            </div>
            @endfor
        </div>

            <!-- Dates -->
        <div>
            <label for="start_date">Data de início</label>
            <input type="datetime-local" id="start_date" name="start_date" required>
        </div>

        <div>
            <label for="end_date">Data de encerramento</label>
            <input type="datetime-local" id="end_date" name="end_date" required>
        </div>

            <!-- Disciplinas -->
        <div>
            <label for="discipline_id">Disciplina</label>
            <select name="discipline_id" id="discipline_id" required>
                <option value="" disabled selected> Selecione uma disciplina</option>
                @foreach($disciplines as $discipline)
                    <option value="{{ $disciplines->id }}"> {{ $discipline->name }}</option>
                @endforeach
            </select>
        </div>

            <!-- Action Buttons -->
        <div>
            <a href="{{ route('missions.index') }}">
                <i></i>
            </a>

            <div>
                <button type="button" id="add-another">
                    <i>Próxima Questão</i> 
                </button>

                <button type="submit">
                    <i>Criar Missão</i>
                </button>
            </div>
        </div>
    </form>
</div>