@extends('layouts.app')

@section('title', 'Todas as Disciplinas')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Todas as Disciplinas Por Categoria</h1>

        @foreach($categories as $category)
            <h2 class="text-2xl font-semibold text-gray-700 mt-10 mb-4">{{ $category }}</h2>

            @if($disciplinesByCategory[$category]->isEmpty())
                <p class="text-gray-500 mb-6">Nenhuma disciplina cadastrada nesta categoria.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($disciplinesByCategory[$category] as $discipline)
                        <div class="bg-white shadow-md rounded-xl overflow-hidden">
                            <img src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image) : asset('assets/disciplines/defalt_discipline.png') }}"
                                alt="{{ $discipline->title }}"
                                class="w-full h-48 object-cover rounded-lg">

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $discipline->title }}</h3>
                                <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($discipline->description, 100) }}
                                </p>
                                <div class="mt-4">
                                    @can('is-subscribed', $discipline)
                                        <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}"
                                        class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Entrar</a>
                                    @elsecan('is-creator', $discipline)
                                        <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}"
                                        class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Entrar</a>
                                    @else
                                        <a href="{{ route('disciplines.show', ['id' => $discipline->id]) }}"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Ver mais</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection
