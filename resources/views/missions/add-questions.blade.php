@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Adicionar Questões à Missão: {{ $mission->title }}</h2>

        <form action="{{ route('missions.storeQuestions', $mission) }}" method="POST">
            @csrf

            <div id="questions-container">
                <!-- Questão inicial -->
                <div class="question-card mb-6 p-4 border rounded-lg">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold">Questão 1</h3>
                        <button type="button" class="remove-question text-red-500 hover:text-red-700">×</button>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Enunciado</label>
                        <textarea name="questions[0][statement]" required rows="3"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Resposta Correta</label>
                        <input type="text" name="questions[0][correct_answer]" required
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Explicação</label>
                        <textarea name="questions[0][explanation]" required rows="2"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Respostas Incorretas (3)</label>
                        <div class="space-y-2">
                            <input type="text" name="questions[0][wrong_answers][]" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="questions[0][wrong_answers][]" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="questions[0][wrong_answers][]" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="button" id="add-question" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                    + Adicionar Outra Questão
                </button>
                
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Finalizar Missão
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let questionCount = 1;
    
    // Adicionar nova questão
    document.getElementById('add-question').addEventListener('click', function() {
        const newQuestion = document.querySelector('.question-card').cloneNode(true);
        const newIndex = questionCount++;
        
        // Atualizar índices
        newQuestion.innerHTML = newQuestion.innerHTML
            .replace(/questions\[0\]/g, `questions[${newIndex}]`)
            .replace('Questão 1', `Questão ${newIndex + 1}`);
            
        // Adicionar ao container
        document.getElementById('questions-container').appendChild(newQuestion);
    });

    // Remover questão
    document.getElementById('questions-container').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-question')) {
            if(document.querySelectorAll('.question-card').length > 1) {
                e.target.closest('.question-card').remove();
                // Reindexar questões restantes
                Array.from(document.querySelectorAll('.question-card')).forEach((card, index) => {
                    card.querySelector('h3').textContent = `Questão ${index + 1}`;
                });
            }
        }
    });
});
</script>
@endsection