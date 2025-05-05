@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

@section('content')
    <h1 class="text-xl font-bold">Olá, bem-vindo ao Mindshub! teste</h1>
    <div class="mt-4">
    @if (!request('search'))
        <h3>Disciplinas Recentemente Acessadas</h3>
        @if ($recentDisciplines->count() > 0)
            <div class="row">
                @foreach ($recentDisciplines as $view)
                    <div class="card col-md-3 mb-3">
                        <small class="text-muted">Acessado {{ $view->viewed_at->diffForHumans() }}</small><br>
                        <img src="{{ asset($view->discipline->image ? 'assets/disciplines/' . $view->discipline->image : 'assets/disciplines/defalt_discipline.png') }}" 
                        alt="{{ $view->discipline->title }}"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $view->discipline->title }}</h5>
                            <p class="card-text">{{ $view->discipline->description }}</p>
                            @can('is-subscribed', $view->discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $view->discipline->id]) }}" class="btn btn-sm btn-success mt-2">Entrar</a>
                            @elsecan('is-creator', $view->discipline)
                                <a href="{{ route('disciplines.showContent', ['id' => $view->discipline->id]) }}" class="btn btn-sm btn-success mt-2">Entrar</a>
                            @else
                                <a href="{{ route('disciplines.show', $view->discipline->id) }}" class="btn btn-sm btn-primary mt-2">Ver mais</a>
                            @endcan
                        

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Você ainda não acessou nenhuma disciplina recentemente.</p>
        @endif
    @endif

    <div class="disciplines mt-4">
        @if (isset($disciplines) && count($disciplines) > 0)
            @if(request('search'))
                <h3>Resultados para: <strong>{{ request('search') }}</strong></h3>
            @else
                <h3>Todas as Disciplinas</h3>
            @endif

            <div id="cards-container" class="row">
                @foreach ($disciplines as $discipline)
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
            </div>
        @else
            <p>Não há disciplinas disponíveis.</p>
        @endif
    </div>
@endsection
