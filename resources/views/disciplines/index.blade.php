@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Disciplinas</h1>
    <a href="{{ route('disciplines.create') }}" class="btn btn-primary mb-3">Nova Disciplina</a>
    <ul class="list-group">
        @foreach ($disciplines as $discipline)
            <li class="list-group-item">
                <a href="{{ route('disciplines.show', $discipline->id) }}">
                    {{ $discipline->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection