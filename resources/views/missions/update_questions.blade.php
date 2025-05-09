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

            <form action="{{ route('missions.updateQuestions', $mission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    @foreach ($questions as $i => $question)
                        <div class="question-card bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <h3 class="text-xl font-semibold text-blue-600 mb-4">Questão {{ $i + 1 }}</h3>

                            <!-- Verificação segura para 'id' -->
                            <input type="hidden" name="questions[{{ $i }}][id]" value="{{ isset($question['id']) ? $question['id'] : '' }}">

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-semibold mb-2">Enunciado</label>
                                <textarea name="questions[{{ $i }}][statement]" required rows="3"
                                    class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">{{ old("questions.$i.statement", $question['statement']) }}</textarea>
                                @error("questions.$i.statement")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Resposta Correta</label>
                                    <input type="text" name="questions[{{ $i }}][correct_answer]" required
                                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md"
                                        value="{{ old("questions.$i.correct_answer", $question['correct_answer']) }}">
                                    @error("questions.$i.correct_answer")
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-semibold mb-2">Respostas Incorretas (3)</label>
                                    <div class="space-y-3">
                                        @isset($question['wrong_answers'])
                                            @php
                                            $wrongs = is_array($question['wrong_answers']) 
                                                ? $question['wrong_answers'] 
                                                : json_decode($question['wrong_answers'], true);
                                            @endphp

                                            @foreach ($wrongs as $j => $wrong)
                                                <input type="text" 
                                                    name="questions[{{ $i }}][wrong_answers][{{ $j }}]" 
                                                    value="{{ old("questions.$i.wrong_answers.$j", $wrong) }}" 
                                                    placeholder="Resposta incorreta {{ $j + 1 }}"
                                                    class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="block text-gray-700 text-sm font-semibold mb-2">Explicação da Resposta Correta</label>
                                <textarea name="questions[{{ $i }}][explanation]" required rows="2"
                                    class="w-full p-3 bg-gray-100 border border-gray-300 rounded-md">{{ old("questions.$i.explanation", $question['explanation']) }}</textarea>
                                @error("questions.$i.explanation")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <a href="{{ route('missions.index', $mission->discipline_id) }}" 
                       class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-6 rounded-md">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md">
                        <i class="fas fa-save mr-2"></i> Atualizar Questões
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection