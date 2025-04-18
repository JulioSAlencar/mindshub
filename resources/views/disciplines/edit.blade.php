<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando: {{ $discipline->title }}</title>
</head>
<body>
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <div class="diciplinas">
        <h1>Editando: {{ $discipline->title }}</h1>
        <form action="{{ route('disciplines.update', $discipline->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}" class="image-preview" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                <br>
                <label for="image">Imagem da disciplina:</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="title">Disciplina:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome da disciplina" value="{{ $discipline->title }}">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Descrição da disciplina">{{ $discipline->description }}</textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Atualizar Disciplina">
        </form>
    </div>
</body>
</html>
