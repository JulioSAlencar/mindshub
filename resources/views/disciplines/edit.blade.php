@extends('layouts.app')

@section('title', $discipline->title)

@section('content')
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex">
        <img src="{{ asset('assets/icons/bookIcon.png') }}" alt="" class="w-[2.5rem] h-[2.5rem] mr-4">
        <h1 class="text-4xl pb-8">Editando {{ $discipline->title }}</h1>
    </div>

    <div class="diciplinas">
        <form action="{{ route('disciplines.update', $discipline->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mt-2 max-w-md">
                <label class="block text-base font-medium text-black-700">Imagem atual da disciplina</label>
                <img src="{{ asset('assets/disciplines/' . $discipline->image) }}" alt="{{ $discipline->title }}" 
                    class="w-[200px] h-[200px] object-cover rounded-lg mt-2 mb-4">
            </div>

            <div class="mt-2 max-w-md">
                <label class="block text-base font-medium text-black-700">Alterar imagem da disciplina</label>
                <input type="file" id="image" name="image"
                    class="w-full text-slate-500 font-medium text-sm bg-white border border-gray-300 file:cursor-pointer cursor-pointer 
                        file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-blue-600 file:hover:bg-blue-700 
                        file:text-white rounded-lg transition-colors" />
                <p class="text-xs text-black-500 mt-2">PNG, JPG e WEBP.</p>
            </div>

            <div class="mt-2 max-w-md">
                <label for="title" class="block text-base font-medium text-black-700">
                    Nome da Disciplina
                </label>
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

            <div class="mt-2 max-w-md">
                <label for="description" class="block text-base font-medium text-black-700">Descrição da Disciplina</label>
                <textarea 
                    id="description" 
                    name="description"
                    class="rounded-md w-full h-32 resize-none border border-gray-300 p-2 
                        focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ $discipline->description }}</textarea>
            </div>
            
            <div class="flex">
                <input type="submit" 
                    class="bg-blue-700 text-white px-12 py-3 rounded-xl mt-4 hover:bg-blue-600 transition duration-300" 
                    value="Atualizar Disciplina">
                <a href="{{ route('disciplines.page')}}" class="bg-gray-700 text-white px-12 py-3 rounded-xl mt-4 hover:bg-gray-600 transition duration-300" >cancelar</a>
            </div>
        </form>
    </div>
@endsection
