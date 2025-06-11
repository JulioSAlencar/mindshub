@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Conteúdo</h2>

    <form method="POST" action="{{ route('contents.update', $content->id) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title', $content->title) }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Substituir arquivo (opcional)</label>
            <input type="file" name="file" id="file" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
            <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter o arquivo atual.</p>
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select name="category" id="category" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="teoria" {{ $content->category == 'teoria' ? 'selected' : '' }}>Teoria</option>
                <option value="resumo" {{ $content->category == 'resumo' ? 'selected' : '' }}>Resumo</option>
                <option value="revisao" {{ $content->category == 'revisao' ? 'selected' : '' }}>Revisão</option>
                <option value="exercicio" {{ $content->category == 'exercicio' ? 'selected' : '' }}>Exercício</option>
                <option value="prova" {{ $content->category == 'prova' ? 'selected' : '' }}>Prova</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">Atualizar</button>
            <a href="{{ route('disciplines.showContent', $content->discipline_id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">Cancelar</a>
        </div>
    </form>
</div>
@endsection
