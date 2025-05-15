@extends('layouts.app')

@section('title', 'Minhas Disciplinas')

@section('content')

    <div class="container mt-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Disciplinas que você está participando</h2>

        @if($disciplines->isEmpty())
            <p>Você ainda não está participando de nenhuma disciplina.</p>
        @else
            <ul class="list-group">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($disciplines as $discipline)
                        <div class="bg-white shadow-md rounded-xl p-4">
                            <img src="/assets/disciplines/{{ $discipline->image }}"
                                alt="{{ $discipline->title }}"
                                class="w-full h-48 object-cover rounded-lg">
                            <div class="mt-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $discipline->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $discipline->description }}</p>
                                <div class="mt-3">
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
            </ul>
        @endif
    </div>

@endsection
