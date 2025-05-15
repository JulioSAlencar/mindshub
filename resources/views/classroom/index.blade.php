@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Salas</h1>
    <a href="{{ route('classrooms.create') }}" class="btn btn-primary mb-3">Nova Sala</a>
    <ul class="list-group">
        @foreach ($classrooms as $classroom)
            <li class="list-group-item">
                {{ $classroom->name }} - Alunos: {{ $classroom->students->count() }}
            </li>
        @endforeach
    </ul>
</div>
@endsection