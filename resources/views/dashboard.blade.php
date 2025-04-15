@extends('layouts.app')

@section('content')
    
    <h1 class="text-xl font-bold">Olá, bem-vindo ao Mindshub!</h1>
    <p>Aqui vai o conteúdo da sua página.</p>
    <h3>Disciplinas Recentes</h3>
    <ul>
        @foreach($recentDisciplines as $view)
            <li>
                <a href="{{ route('disciplines.show', $view->discipline->id) }}">
                    {{ $view->discipline->nome }}
                </a> ({{ $view->viewed_at->diffForHumans() }})
            </li>
        @endforeach
    </ul>
    <div class="disciplines">
        @if (isset($disciplines) && count($disciplines) > 0)
            <h1>Todas as Disciplinas</h1>
            <div id="cards-container" class="row">
                @foreach ($disciplines as $discipline)
                    <div class="card col-md-3">
                        <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}"
                            style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $discipline->title }}</h5>
                            <h5 class="card-title">{{ $discipline->description }}</h5>
                            <a href="/disciplines/{{ $discipline->id }}" class="btn btn-primary">Ver mais</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Não há disciplinas disponíveis</p>
        @endif
    </div>
@endsection
