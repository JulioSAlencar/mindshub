@extends('layouts.app')

@section('title', $discipline->title)

@section('content')
    @if (session('error'))
        <div class="text-red-600 text-center mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/icons/bookIcon.png') }}" alt="" class="w-10 h-10 mr-4">
            <h1 class="text-3xl font-bold text-gray-800">Editando {{ $discipline->title }}</h1>
        </div>

        <form action="{{ route('disciplines.update', $discipline->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-base font-medium text-gray-700">Imagem atual da disciplina</label>
                <img src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image) : asset('assets/disciplines/default_discipline.png') }}" alt="{{ $discipline->title }}"
                    class="w-48 h-48 object-cover rounded-lg mt-2">
            </div>

            <div class="mb-4">
                <label class="block text-base font-medium text-gray-700">Alterar imagem da disciplina</label>
                <input type="file" id="image" name="image"
                    class="w-full text-sm text-slate-500 bg-white border border-gray-300 rounded-lg
                        file:cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-blue-600 
                        file:hover:bg-blue-700 file:text-white transition-colors" />
                <p class="text-xs text-gray-500 mt-2">Formatos aceitos: PNG, JPG, WEBP.</p>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-base font-medium text-gray-700">Nome da Disciplina</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ $discipline->title }}"
                    placeholder="Digite o nome da disciplina"
                    class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        placeholder:text-gray-400 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="description" class="block text-base font-medium text-gray-700">Descrição da Disciplina</label>
                <textarea 
                    id="description" 
                    name="description"
                    class="mt-2 w-full h-32 resize-none border border-gray-300 rounded-md p-2 
                        focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ $discipline->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Área de Conhecimento</label>
                <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $discipline->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="flex gap-4">
                <input type="submit" 
                    class="bg-blue-700 text-white px-8 py-3 rounded-xl hover:bg-blue-600 transition duration-300" 
                    value="Atualizar Disciplina">
                <a href="{{ route('disciplines.page') }}"
                   class="bg-gray-700 text-white px-8 py-3 rounded-xl hover:bg-gray-600 transition duration-300">
                   Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
