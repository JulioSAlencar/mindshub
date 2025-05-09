@extends('layouts.app')

@section('content')

{{-- Aplica um fundo cinza à página, similar ao design do seu amigo --}}
<div class="bg-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        {{-- Card principal que engloba o formulário, com o estilo do seu amigo --}}
        <div class="max-w-4xl mx-auto bg-white rounded-md shadow-lg p-6">
            
            {{-- Cabeçalho da Missão com Ícone (do design do seu amigo) --}}
            <div class="flex items-center mb-8">
                <div class="bg-blue-500 text-white p-3 rounded-md mr-4 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Adicionar Questões à Missão: {{ $mission->title }}</h1>
            </div>

            @php
                $initialQuestionCount = count(old('questions', []));
                if ($initialQuestionCount === 0) {
                    $initialQuestionCount = request()->input('questions', 1);
                }
                $questionCount = min(max($initialQuestionCount, 1), 10); // Limita entre 1 e 10
                $oldQuestions = session()->get('temp_questions', old('questions', []));
            @endphp
            
            <form action="{{ route('missions.storeQuestions', $mission) }}" method="POST" id="questions-form">
                @csrf
                <input type="hidden" name="total_questions" id="total_questions" value="{{ $questionCount }}">
                
                <div id="questions-container" class="space-y-8">
                    @for ($i = 0; $i < $questionCount; $i++)
                        {{-- Card individual para cada questão --}}
                        <div class="question-card bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold text-blue-600 question-title">Questão <span class="question-number">{{ $i + 1 }}</span></h3>
                                {{-- Botão de remover só aparece para questões além da primeira, ou se for adicionada por JS --}}
                                @if ($i > 0 || $questionCount > 1) {{-- Lógica para exibir o botão de remover em cartões iniciais se necessário --}}
                                    {{-- Este botão é mais para o template JS, mas pode ser condicional aqui --}}
                                    {{-- <button type="button" onclick="removeQuestionFromForm(this, true)" class="text-red-500 hover:text-red-700 text-2xl font-bold leading-none">&times;</button> --}}
                                @endif
                            </div>
            
                            {{-- Enunciado --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_{{ $i }}_statement">Enunciado da Questão</label>
                                <textarea name="questions[{{ $i }}][statement]" id="questions_{{ $i }}_statement" required rows="3"
                                          class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">{{ $oldQuestions[$i]['statement'] ?? '' }}</textarea>
                            </div>
            
                            {{-- Grid para Resposta Correta e Incorretas (Layout do amigo) --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_{{ $i }}_correct_answer">Resposta Correta</label>
                                    <input type="text" name="questions[{{ $i }}][correct_answer]" id="questions_{{ $i }}_correct_answer" required
                                           class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out"
                                           value="{{ $oldQuestions[$i]['correct_answer'] ?? '' }}">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Respostas Incorretas (3)</label>
                                    <div class="space-y-3">
                                        @for ($j = 0; $j < 3; $j++)
                                            <input type="text" name="questions[{{ $i }}][wrong_answers][]" id="questions_{{ $i }}_wrong_answers_{{ $j }}"
                                                   required
                                                   placeholder="Resposta incorreta {{ $j + 1 }}"
                                                   class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out"
                                                   value="{{ isset($oldQuestions[$i]['wrong_answers'][$j]) ? $oldQuestions[$i]['wrong_answers'][$j] : (isset($oldQuestions[$i]['wrong_answers']) && is_array($oldQuestions[$i]['wrong_answers']) && array_key_exists($j, $oldQuestions[$i]['wrong_answers']) ? $oldQuestions[$i]['wrong_answers'][$j] : '') }}">
                                        @endfor
                                    </div>
                                </div>
                            </div>
            
                            {{-- Explicação --}}
                            <div class="mb-2"> {{-- Reduzido o mb para não ficar muito espaçado antes do fim do card --}}
                                <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_{{ $i }}_explanation">Explicação da Resposta Correta</label>
                                <textarea name="questions[{{ $i }}][explanation]" id="questions_{{ $i }}_explanation" required rows="2"
                                          class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">{{ $oldQuestions[$i]['explanation'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
                {{-- Botões de Ação --}}
                <div class="mt-6 flex justify-end gap-4 ">
                    <button type="button" id="add-question-btn" 
                             class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md">
                        <i class="fas fa-plus mr-2"></i> Adicionar Outra Questão
                    </button>
                    
                    <button type="submit" 
                             class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md">
                        <i class="fas fa-check mr-2"></i> Finalizar e Criar Missão
                    </button>
                </div>
            </form>
            
            {{-- Template para novas questões (deve espelhar a estrutura e classes de um question-card) --}}
            <div id="question-template" style="display: none;">
                <div class="question-card bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-blue-600 question-title">Questão <span class="question-number-placeholder">X</span></h3>
                        <button type="button" onclick="removeQuestionFromForm(this)" class="text-red-500 hover:text-red-700 text-2xl font-bold leading-none">&times;</button>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_INDEX_statement">Enunciado da Questão</label>
                        <textarea name="questions[INDEX][statement]" id="questions_INDEX_statement" required rows="3" class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_INDEX_correct_answer">Resposta Correta</label>
                            <input type="text" name="questions[INDEX][correct_answer]" id="questions_INDEX_correct_answer" required class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" value="">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Respostas Incorretas (3)</label>
                            <div class="space-y-3">
                                @for ($j = 0; $j < 3; $j++)
                                    <input type="text" name="questions[INDEX][wrong_answers][]" id="questions_INDEX_wrong_answers_{{ $j }}" placeholder="Resposta incorreta {{ $j + 1 }}" required class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" value="">
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_INDEX_explanation">Explicação da Resposta Correta</label>
                        <textarea name="questions[INDEX][explanation]" id="questions_INDEX_explanation" required rows="2" class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Seu script JS deve ser carregado após o HTML, idealmente no fim do body ou aqui --}}
<script src="{{ asset('js/mission-form.js')}}"></script>
{{-- Adicionei um data attribute para o botão de remover nos cartões iniciais se quiser diferenciar a lógica no JS --}}

@endsection