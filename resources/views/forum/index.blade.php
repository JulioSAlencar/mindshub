@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fórum</h1>
    <a href="{{ route('forum.topics.create') }}" class="btn btn-success mb-3">Novo Tópico</a>

    @foreach($topics as $topic)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $topic->title }}</h5>
                <p class="card-text">{{ $topic->description }}</p>
                <a href="{{ route('forum.topics.show', $topic->id) }}" class="btn btn-primary">Ver Respostas</a>
            </div>
        </div>
    @endforeach
</div>
@endsection