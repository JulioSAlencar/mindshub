@extends('layouts.app')

@section('title', 'Minhas Disciplinas')

@section('content')

    <div class="container mt-4">
        <h2 class="mb-3">Disciplinas que você está participando</h2>

        @if($disciplines->isEmpty())
            <p>Você ainda não está participando de nenhuma disciplina.</p>
        @else
            <ul class="list-group">
                @foreach($disciplines as $discipline)
                    <div class="card col-md-3 mb-3">
                        <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}"
                            style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $discipline->title }}</h5>
                            <p class="card-text">{{ $discipline->description }}</p>
                            @can('is-subscribed', $discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}" class="btn btn-success">Entrar</a>
                            @elsecan('is-creator', $discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}" class="btn btn-success">Entrar</a>
                            @else
                                <a href="{{ route('disciplines.show', ['id' => $discipline->id]) }}" class="btn btn-primary">Ver mais</a>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </ul>
        @endif
    </div>

@endsection
