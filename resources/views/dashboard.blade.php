@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
@section('content')
    
    <h1 class="text-xl font-bold">Olá, bem-vindo ao Mindshub!</h1>
    <p>Aqui vai o conteúdo da sua página.</p>
    <h3>Disciplinas Recentemente Acessadas</h3>

    @if($recentDisciplines->count() > 0)
        <div class="row">
            @foreach($recentDisciplines as $view)
                <div class="card col-md-3 mb-3">
                    <small class="text-muted">Acessado {{ $view->viewed_at->diffForHumans() }}</small><br>
                    <img src="/assets/disciplines/{{ $view->discipline->image }}" 
                        alt="{{ $view->discipline->title }}"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $view->discipline->title }}</h5>
                        <p class="card-text">{{ $view->discipline->description }}</p>
                        <a href="{{ route('disciplines.show', $view->discipline->id) }}" class="btn btn-sm btn-primary mt-2">Ver mais</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Você ainda não acessou nenhuma disciplina recentemente.</p>
    @endif

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
