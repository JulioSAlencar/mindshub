@extends('layouts.app')

@section('content')
<div class="flex justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl">
        @if (session('error'))
            <div class="text-red-600 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/icons/bookIcon.png') }}" alt="Ícone Livro" class="w-[2.5rem] h-[2.5rem] mr-4">
            <h1 class="text-4xl font-semibold text-gray-800">Criar disciplina</h1>
        </div>

        <form action="/disciplines" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-base font-medium text-gray-700 mb-1">Adicionar imagem para disciplina</label>
                <input type="file" id="image" name="image"
                    class="w-full text-sm text-gray-600 bg-white border border-gray-300 
                           file:cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 
                           file:bg-blue-600 file:hover:bg-blue-700 file:text-white 
                           rounded-lg transition-colors" />
                <p class="text-xs text-gray-500 mt-1">PNG, JPG e WEBP são suportados.</p>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-base font-medium text-gray-700 mb-1">
                    Nome da Disciplina
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    placeholder="Digite o nome da disciplina"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                           placeholder:text-gray-400 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="description" class="block text-base font-medium text-gray-700 mb-1">
                    Descrição da Disciplina
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    class="w-full h-32 resize-none border border-gray-300 p-2 rounded-md 
                           focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Área de Conhecimento</label>
                <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $discipline->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <input 
                type="submit" 
                value="Criar Disciplina"
                class="bg-blue-700 text-white px-12 py-3 rounded-xl hover:bg-blue-600 transition duration-300 w-full sm:w-auto">
        </form>
    </div>

</div>
@endsection
