<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laravel</title>
</head>
<body>

    <div class="diciplinas">
        <h1>criar disicplina</h1>
        <form action="/disciplines" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagem da disciplina:</label>
                <input type="file" id="image" name="image" class="from-control-file">
            </div>
            <div class="form-group">
                <label for="title">Disciplina:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome da disciplina">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Descrição da disciplina"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Criar Disciplina">
        </form>
    </div>
</body>
</html>
