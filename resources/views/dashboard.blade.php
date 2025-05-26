@extends('layouts.app')

@section('content')

{{-- Conteúdo da dashboard --}}
@if (!request('search'))
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Olá, bem-vindo ao Mindshub!</h1>

    <h2 class="text-xl font-semibold text-gray-700 mb-4">Disciplinas Recentemente Acessadas</h2>
    @if ($recentDisciplines->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($recentDisciplines as $view)
                <div class="bg-white shadow-md rounded-xl p-4">
                    <img src="{{ asset($view->discipline->image ? 'assets/disciplines/' . $view->discipline->image : 'assets/disciplines/defalt_discipline.png') }}"
                         alt="{{ $view->discipline->title }}"
                         class="w-full h-48 object-cover rounded-lg mt-2">
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $view->discipline->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $view->discipline->description }}</p>
                        <div class="mt-3">
                            @can('is-subscribed', $view->discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $view->discipline->id]) }}"
                                   class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Entrar</a>
                            @elsecan('is-creator', $view->discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $view->discipline->id]) }}"
                                   class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Entrar</a>
                            @else
                                <a href="{{ route('disciplines.show', $view->discipline->id) }}"
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Ver mais</a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Você ainda não acessou nenhuma disciplina recentemente.</p>
    @endif
@endif

<div class="mt-10">
    @if (isset($disciplines) && count($disciplines) > 0)
        @if(request('search'))
            <h2 class="text-xl font-semibold text-gray-700 mb-4">
                Resultados para: <span class="font-bold">{{ request('search') }}</span>
            </h2>
        @else
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Todas as Disciplinas</h2>
            <a href="{{ route('dash_disciplines.allDisciplines')}}">Ver mais</a>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($disciplines as $discipline)
                <div class="bg-white shadow-md rounded-xl p-4">
                    <img src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image) : asset('assets/disciplines/defalt_discipline.png') }}"
                         alt="{{ $discipline->title }}"
                         class="w-full h-48 object-cover rounded-lg">
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $discipline->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $discipline->description }}</p>
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
    @else
        @if(request('search'))
            <p class="text-gray-600">Não há disciplinas disponíveis sobre <span class="font-semibold">{{ request('search') }}</span>.</p>
        @else
            <p class="text-gray-600">Não há disciplinas disponíveis.</p>
        @endif
    @endif
</div>
@endsection

