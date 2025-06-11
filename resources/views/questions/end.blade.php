@extends('layouts.app')

@section('content')
<div class="container mt-6">

    {{-- Caixa de conclusão da missão --}}
    <div class="max-w-2xl mx-auto bg-white text-gray-900 p-8 rounded-xl shadow-lg mb-8">
        <h1 class="text-3xl font-bold mb-4 text-green-600 text-center">Missão Concluída!</h1>
        <p class="text-xl text-center mb-4">Você ganhou <span class="font-bold text-green-600">{{ $xpEarned ?? '?' }}</span> XP!</p>
        <div class="text-center">

            {{-- Botão para ver resultado da missão específica --}}
            @if ($mission)
                <a href="{{ route('missions.result', $mission->id) }}" class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition font-medium mb-3">
                    Ver meu resultado
                </a>
            @else
                <p class="text-red-500">Não foi possível encontrar os detalhes da missão.</p>
            @endif

            <br>

            {{-- Botão para voltar à disciplina --}}
            <a href="{{ route('disciplines.showContent', $discipline->id) }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition font-medium">
                Voltar para {{ $discipline->name ?? 'Disciplina' }}
            </a>
        </div>
    </div>

    {{-- Caixa de feedback separada --}}
    <div class="max-w-2xl mx-auto bg-white text-gray-900 p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Deixe seu Feedback</h2>

        @if (!$hasFeedback)
            <form id="feedback-form" method="POST" action="{{ route('feedback.store') }}">
                @csrf
                <input type="hidden" name="mission_id" value="{{ $mission->id }}">

                <div class="mb-4">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Categoria do Feedback (opcional)</label>
                    <select id="category" name="category" class="w-full bg-gray-100 border border-gray-300 text-gray-900 p-2 rounded">
                        <option value="">Nenhuma</option>
                        <option value="dificuldade">Dificuldade</option>
                        <option value="qualidade">Qualidade</option>
                        <option value="elogio">Elogio</option>
                        <option value="sugestao">Sugestão</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-700">Deixe seu feedback (opcional)</label>
                    <textarea id="content" name="content" rows="4" class="w-full bg-gray-100 border border-gray-300 text-gray-900 p-2 rounded"></textarea>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Enviar Feedback
                </button>

                <p id="feedback-message" class="mt-4 text-center text-green-600 font-semibold hidden"></p>
            </form>
        @else
            <p class="text-green-600 text-center text-lg">Você já enviou seu feedback para esta missão. Obrigado!</p>
        @endif
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feedback-form');
    const message = document.getElementById('feedback-message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        message.classList.add('hidden');
        message.textContent = '';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            message.textContent = data.message;
            message.classList.remove('hidden', 'text-red-500');
            message.classList.add('text-green-600');

            // Opcional: limpar campos do formulário
            form.reset();
        })
        .catch(error => {
            let errorMsg = 'Erro ao enviar feedback.';
            if (error && error.message) {
                errorMsg = error.message;
            }
            message.textContent = errorMsg;
            message.classList.remove('hidden', 'text-green-600');
            message.classList.add('text-red-500');
        });
    });
});
</script>

@endsection
