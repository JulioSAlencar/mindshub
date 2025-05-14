@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Conteúdo</h2>

    <form method="POST" action="{{ route('contents.update', $content->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title', $content->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Substituir arquivo (opcional)</label>
            <input type="file" name="file" class="form-control">
            <small class="form-text text-muted">Deixe em branco para manter o arquivo atual.</small>
        </div>
        <div class="mb-3">
            <select name="category" id="category" required>
                <option value="teoria" {{ $content->category == 'teoria' ? 'selected' : '' }}>Teoria</option>
                <option value="resumo" {{ $content->category == 'resumo' ? 'selected' : '' }}>Resumo</option>
                <option value="revisao" {{ $content->category == 'revisao' ? 'selected' : '' }}>Revisão</option>
                <option value="exercicio" {{ $content->category == 'exercicio' ? 'selected' : '' }}>Exercício</option>
                <option value="prova" {{ $content->category == 'prova' ? 'selected' : '' }}>Prova</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('disciplines.showContent', $content->discipline_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
