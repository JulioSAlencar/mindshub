<form action="{{ route('missions.store') }}" method="POST" id="mission-form">
    @csrf
    <input type="hidden" name="discipline_id" value="{{ $discipline->id }}">

    <div id="missions-wrapper">
        {{-- Primeira missão --}}
        <div class="mission-block" data-index="0">
            <h5>1/10 Questão</h5>

            <label>Enunciado</label>
            <textarea name="missions[0][statement]" required></textarea>

            <label>Resposta correta</label>
            <input type="text" name="missions[0][correct_answer]" required>

            <label>Explicação</label>
            <textarea name="missions[0][explanation]" required></textarea>

            <label>Respostas erradas</label>
            <input type="text" name="missions[0][wrong_answers][]" required placeholder="Errada 1">
            <input type="text" name="missions[0][wrong_answers][]" required placeholder="Errada 2">
            <input type="text" name="missions[0][wrong_answers][]" required placeholder="Errada 3">

            <label>Data de início</label>
            <input type="datetime-local" name="missions[0][start_date]" required>

            <label>Data de encerramento</label>
            <input type="datetime-local" name="missions[0][end_date]" required>
        </div>
    </div>

    <button type="button" id="add-mission">+ Próxima Questão</button>
    <button type="submit">Criar Missões</button>
</form>
<script src="{{ asset('js/mission-form.js') }}"></script>
