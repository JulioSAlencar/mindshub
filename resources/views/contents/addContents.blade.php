@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100 p-6">
    <div class="w-full max-w-2xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
            Adicionar Conteúdo à Disciplina: <span class="text-indigo-600">{{ $discipline->title }}</span>
        </h2>

        <!-- Formulário de envio -->
        <form method="POST" action="{{ route('contents.store', $discipline->id) }}" enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-1">Título do conteúdo:</label>
                <input type="text" id="title" name="title" placeholder="Digite o título"
                       required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label for="file" class="block text-gray-700 font-semibold mb-1">Arquivo:</label>
                <input type="file" id="file" name="file" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-6">
                <label for="category" class="block text-gray-700 font-semibold mb-1">Categoria:</label>
                <select name="category" id="category" required
                        class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="teoria">Teoria</option>
                    <option value="resumo">Resumo</option>
                    <option value="revisao">Revisão</option>
                    <option value="exercicio">Exercício</option>
                    <option value="prova">Prova</option>
                </select>
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Enviar Conteúdo
            </button>
        </form>
    </div>
</div>

@endsection
