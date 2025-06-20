@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-md shadow-lg p-6">

            <div class="flex items-center mb-8">
                <div class="bg-blue-500 text-white p-3 rounded-md mr-4 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 ml-6">Editar Questões da Missão: {{ $mission->title }}</h1>
            </div>

            <form action="{{ route('questions.update', $mission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div id="questions-container" class="space-y-8">
                    @if (count($questions) === 0)
                        <div class="bg-yellow-100 text-yellow-800 p-4 mb-6 rounded no-questions-message">
                            Nenhuma questão foi adicionada ainda. Adicione a primeira questão abaixo.
                        </div>
                        <div class="question-card bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <h3 class="text-xl font-semibold text-blue-600 mb-4">Nova Questão</h3>
                            <input type="hidden" name="questions[0][id]" value="">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-semibold mb-2">Enunciado</label>
                                <textarea name="questions[0][statement]" required rows="3"
                                    class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">{{ old("questions.0.statement") }}</textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Resposta Correta</label>
                                    <input type="text" name="questions[0][correct_answer]" required
                                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md"
                                        value="{{ old("questions.0.correct_answer") }}">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Respostas Incorretas (3)</label>
                                    <div class="space-y-3">
                                        @for ($j = 0; $j < 3; $j++)
                                            <input type="text"
                                                name="questions[0][wrong_answers][{{ $j }}]"
                                                value="{{ old("questions.0.wrong_answers.$j") }}"
                                                placeholder="Resposta incorreta {{ $j + 1 }}" required
                                                class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="block text-gray-700 text-sm font-semibold mb-2">Explicação da Resposta Correta</label>
                                <textarea name="questions[0][explanation]" required rows="2"
                                    class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">{{ old("questions.0.explanation") }}</textarea>
                            </div>
                        </div>
                    @else
                        @foreach ($questions as $i => $question)
                            @php
                                $question = is_object($question) ? (array) $question : $question;
                                $wrongAnswers = is_string($question['wrong_answers']) ? json_decode($question['wrong_answers'], true) : $question['wrong_answers'];
                                $wrongAnswers = is_array($wrongAnswers) ? $wrongAnswers : [];
                            @endphp

                            <div class="question-card bg-white p-6 rounded-lg shadow-md border border-gray-200">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-semibold text-blue-600 question-title">Questão {{ $i + 1 }}</h3>
                                    @if ($i > 0)
                                        <button type="button" onclick="removeQuestionFromForm(this)" class="text-red-500 hover:text-red-700 text-2xl font-bold leading-none">&times;</button>
                                    @endif
                                </div>

                                <input type="hidden" name="questions[{{ $i }}][id]" value="{{ $question['id'] ?? '' }}">

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Enunciado</label>
                                    <textarea name="questions[{{ $i }}][statement]" required rows="3"
                                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">{{ old("questions.$i.statement", $question['statement'] ?? '') }}</textarea>
                                    @error("questions.$i.statement")
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2">Resposta Correta</label>
                                        <input type="text" name="questions[{{ $i }}][correct_answer]" required
                                            class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md"
                                            value="{{ old("questions.$i.correct_answer", $question['correct_answer'] ?? '') }}">
                                        @error("questions.$i.correct_answer")
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2">Respostas Incorretas (3)</label>
                                        <div class="space-y-3">
                                            @for ($j = 0; $j < 3; $j++)
                                                <input type="text"
                                                    name="questions[{{ $i }}][wrong_answers][{{ $j }}]"
                                                    value="{{ old("questions.$i.wrong_answers.$j", $wrongAnswers[$j] ?? '') }}"
                                                    placeholder="Resposta incorreta {{ $j + 1 }}" required
                                                    class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">
                                                @error("questions.$i.wrong_answers.$j")
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Explicação da Resposta Correta</label>
                                    <textarea name="questions[{{ $i }}][explanation]" required rows="2"
                                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">{{ old("questions.$i.explanation", $question['explanation'] ?? '') }}</textarea>
                                    @error("questions.$i.explanation")
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" id="add-question-btn"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md shadow transition duration-150 ease-in-out">
                        <i class="fas fa-plus mr-2"></i> Adicionar Questão
                    </button>
                    <a href="{{ route('missions.index', ['discipline' => $mission->discipline_id]) }}"
                       class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-6 rounded-md shadow transition duration-150 ease-in-out">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md shadow transition duration-150 ease-in-out">
                        <i class="fas fa-save mr-2"></i> Atualizar Questões
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="question-template" style="display: none;">
        <div class="question-card bg-white p-6 rounded-lg shadow-md border border-gray-200 mt-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-blue-600 question-title">Questão <span class="question-number-placeholder">X</span></h3>
                <button type="button" onclick="removeQuestionFromForm(this)" class="text-red-500 hover:text-red-700 text-2xl font-bold leading-none">&times;</button>
            </div>
            <input type="hidden" name="questions[INDEX][id]" value="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="questions_INDEX_statement">Enunciado</label>
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
                            <input type="text" name="questions[INDEX][wrong_answers][{{ $j }}]" id="questions_INDEX_wrong_answers_{{ $j }}" placeholder="Resposta incorreta {{ $j + 1 }}" required class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" value="">
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

<script src="{{ asset('js/mission-form.js')}}"></script>
@endsection
