@extends('layouts.app')

@section('content')

@if (!request('search'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center">
            Olá, bem-vindo ao <span class="text-blue-600">Mindshub!</span>
        </h1>

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Disciplinas Recentemente Acessadas</h2>

        @if ($recentDisciplines->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($recentDisciplines as $view)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden flex flex-col">
                        <img 
                            src="{{ asset($view->discipline->image ? 'assets/disciplines/' . $view->discipline->image : 'assets/disciplines/default_discipline.png') }}"
                            alt="{{ $view->discipline->title }}"
                            class="w-full h-48 object-cover"
                        >

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-semibold text-gray-900 truncate" title="{{ $view->discipline->title }}">
                                {{ $view->discipline->title }}
                            </h3>

                            <p class="text-gray-600 mt-2 line-clamp-3 flex-grow">
                                {{ $view->discipline->description }}
                            </p>

                            <div class="mt-4">
                                @can('is-subscribed', $view->discipline)
                                    <a href="{{ route('disciplines.showContent', ['id' => $view->discipline->id]) }}"
                                       class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                                        Entrar
                                    </a>
                                @elsecan('is-creator', $view->discipline)
                                    <a href="{{ route('disciplines.showContent', ['id' => $view->discipline->id]) }}"
                                       class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                                        Entrar
                                    </a>
                                @else
                                    <a href="{{ route('disciplines.show', $view->discipline->id) }}"
                                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                                        Ver mais
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-600 mt-6">Você ainda não acessou nenhuma disciplina recentemente.</p>
        @endif
    </div>
@endif

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if (isset($disciplines) && count($disciplines) > 0)
        @if(request('search'))
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                Resultados para: <span class="font-bold text-gray-900">{{ request('search') }}</span>
            </h2>
        @else
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Todas as Disciplinas</h2>
                <a href="{{ route('dash_disciplines.allDisciplines') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                   Ver mais &rarr;
                </a>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($disciplines as $discipline)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden flex flex-col">
                    <img 
                        src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image) : asset('assets/disciplines/default_discipline.png') }}"
                        alt="{{ $discipline->title }}"
                        class="w-full h-48 object-cover"
                    >

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold text-gray-900 truncate" title="{{ $discipline->title }}">
                            {{ $discipline->title }}
                        </h3>

                        <p class="text-gray-600 mt-2 line-clamp-3 flex-grow">
                            {{ $discipline->description }}
                        </p>

                        <div class="mt-4">
                            @can('is-subscribed', $discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}"
                                   class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                                    Entrar
                                </a>
                            @elsecan('is-creator', $discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}"
                                   class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                                    Entrar
                                </a>
                            @else
                                <a href="{{ route('disciplines.show', ['id' => $discipline->id]) }}"
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200">
                                    Ver mais
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 mt-6">
            @if(request('search'))
                Não há disciplinas disponíveis sobre <span class="font-semibold">{{ request('search') }}</span>.
            @else
                Não há disciplinas disponíveis.
            @endif
        </p>
    @endif
</div>

@endsection
