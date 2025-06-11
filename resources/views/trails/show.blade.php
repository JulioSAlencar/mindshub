@extends('layouts.app')

@section('title', 'Todas as Disciplinas')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-gray-800 mb-10">Todas as Disciplinas</h1>

        <!-- Mensagem quando não há disciplinas -->
    @if ($disciplines->isEmpty())
        <div class="text-center text-gray-700 mb-8">
            <p class="text-xl font-semibold">Você ainda não está inscrito em nenhuma disciplina.</p>
            <p class="text-gray-600 mt-2">Inscreva-se em alguma disciplina para começar a visualizar as trilhas disponíveis.</p>
        </div>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($disciplines as $discipline)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="relative">
                    <img 
                        src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image) : asset('assets/disciplines/default_discipline.png') }}"
                        alt="{{ $discipline->title }}"
                        class="w-full h-48 object-cover"
                    >
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">{{ $discipline->title }}</h2>
                    </div>
                </div>

                @php
                    $total = $discipline->total ?? 0;
                    $completed = $discipline->completed ?? 0;
                    $percent = $total > 0 ? ($completed / $total) * 100 : 0;
                @endphp

                <div class="px-6 py-5">
                    <!-- Barra de progresso -->
                    <div class="w-full bg-gray-200 h-5 rounded-full overflow-hidden mb-3">
                        <div 
                            class="bg-green-500 h-full text-xs text-white font-semibold text-center transition-all duration-500 ease-in-out"
                            style="width: {{ $percent }}%"
                        >
                            {{ round($percent) }}%
                        </div>
                    </div>

                    <!-- Detalhes das missões -->
                    <p class="text-gray-600 text-sm">
                        Missões completas: 
                        <span class="font-medium text-gray-800">{{ $completed }}</span> 
                        de 
                        <span class="font-medium text-gray-800">{{ $total }}</span>
                    </p>

                    <!-- Botões -->
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
</div>
@endsection
