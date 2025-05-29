@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="max-w-2xl mx-auto bg-gray-800 text-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Missão Concluída!</h1>

        <p class="mb-4">Parabéns por concluir a missão <strong>{{ $mission->title }}</strong>!</p>

        @if (!$hasFeedback)
            <form method="POST" action="{{ route('mission.feedback.store', $mission->id) }}">
                @csrf

                <div class="mb-4">
                    <label for="category" class="block mb-2 text-sm font-medium">Categoria do Feedback (opcional)</label>
                    <select id="category" name="category" class="w-full bg-gray-700 border border-gray-600 text-white p-2 rounded">
                        <option value="">Nenhuma</option>
                        <option value="dificuldade">Dificuldade</option>
                        <option value="qualidade">Qualidade</option>
                        <option value="elogio">Elogio</option>
                        <option value="sugestão">Sugestão</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="content" class="block mb-2 text-sm font-medium">Deixe seu feedback (opcional)</label>
                    <textarea id="content" name="content" rows="4" class="w-full bg-gray-700 border border-gray-600 text-white p-2 rounded"></textarea>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Enviar Feedback
                </button>
            </form>
        @else
            <p class="text-green-400">Você já enviou seu feedback para esta missão. Obrigado!</p>
        @endif
    </div>
</div>
@endsection