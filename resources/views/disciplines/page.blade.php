<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <br>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Minhas Disciplinas</h1>
    </div>
    <div  class="col-md-10 offset-md-1">
        <a class="btn btn-primary" href="{{ route('disciplines.create')}}">criar nova disciplina</a>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($disciplines) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($disciplines as $discipline)
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td><a href="/disciplines/{{ $discipline->id }}">{{ $discipline->title }}</a></td>
                        <td>0</td>
                        <td>
                            <a class="btn btn-primary" href="/disciplines/{{ $discipline->id }}">ver</a>
                            <a class="btn btn-secondary" href="/disciplines/edit/{{ $discipline->id }}">Editar</a>
                            
                            <form action="{{ route('disciplines.destroy', $discipline->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>                
                @endforeach    
            </tbody>
        </table>
        @else
        <p>Você ainda não tem disciplina, <a href="{{ route('disciplines.create')}}">criar nova disciplina</a></p>
        @endif
    </div>
</body>
</html>
