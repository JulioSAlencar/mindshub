@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Trilha da Disciplina: {{ $discipline->title }}</h1>

    <p><strong>Total de Missões:</strong> {{ $missions->count() }}</p>

    <ul class="list-group">
        @forelse($missions as $mission)
            <li class="list-group-item">
                <strong>{{ $mission->title }}</strong><br>
                {{ $mission->description }}
            </li>
        @empty
            <li class="list-group-item">Nenhuma missão cadastrada.</li>
        @endforelse
    </ul>
</div>
@endsection
