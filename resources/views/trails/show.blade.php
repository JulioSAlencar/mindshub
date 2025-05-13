@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Minhas Trilhas por Disciplinas</h1>

    @foreach($disciplines as $discipline)
    
    <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $discipline->title }}</h3>
        <ul class="list-group mb-3">
            @forelse($discipline->missions as $mission)
                <li class="list-group-item">
                    <strong class="font-normal text-gray-700 dark:text-gray-400">{{ $discipline->missions->count() }}</strong>
                </li>
            @empty
                <li class="list-group-item">Nenhuma missão cadastrada.</li>
            @endforelse
        </ul>
    </div>
    @endforeach
</div>
@endsection
