<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<form action="{{ route('missions.store') }}" method="POST" id="mission-form" class="container mt-4">
    @csrf
    <input type="hidden" name="discipline_id" value="{{ $discipline->id }}">

    <div id="missions-wrapper">
        {{-- Primeira missão --}}
        <div class="mission-block border rounded p-4 mb-4 shadow-sm bg-light" data-index="0">
            <h5 class="mb-3">1/10 Questão</h5>

            <div class="mb-3">
                <label class="form-label">Enunciado</label>
                <textarea class="form-control" name="missions[0][statement]" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Resposta correta</label>
                <input type="text" class="form-control" name="missions[0][correct_answer]" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Explicação</label>
                <textarea class="form-control" name="missions[0][explanation]" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Respostas erradas</label>
                <input type="text" class="form-control mb-2" name="missions[0][wrong_answers][]" required placeholder="Errada 1">
                <input type="text" class="form-control mb-2" name="missions[0][wrong_answers][]" required placeholder="Errada 2">
                <input type="text" class="form-control" name="missions[0][wrong_answers][]" required placeholder="Errada 3">
            </div>

            <div class="mb-3">
                <label class="form-label">Data de início</label>
                <input type="datetime-local" class="form-control" name="missions[0][start_date]" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Data de encerramento</label>
                <input type="datetime-local" class="form-control" name="missions[0][end_date]" required>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <button type="button" id="add-mission" class="btn btn-outline-primary">+ Próxima Questão</button>
        <button type="submit" class="btn btn-success">Criar Missões</button>
    </div>
</form>

<script src="{{ asset('js/mission-form.js') }}"></script>

