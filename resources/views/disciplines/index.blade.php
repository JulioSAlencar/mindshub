@foreach($disciplines as $discipline)
    <div>
        <h3>{{ $discipline->title }}</h3>
        <a href="{{ route('missions.create', ['discipline' => $discipline->id]) }}">Criar missão</a>
    </div>
@endforeach
