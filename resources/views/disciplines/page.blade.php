<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
</head>
<body>
    @if(request()->has('msg'))
        <div class="alert alert-success">
            {{ urldecode(request()->query('msg')) }}
        </div>
    @endif
    <a href="{{ route('disciplines.create')}}">criar nova disciplina</a>
    <br>

    @if(isset($disciplines) && count($disciplines) > 0)
        <div id="cards-container" class="row">
            @foreach($disciplines as $discipline)
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
</body>
</html>
