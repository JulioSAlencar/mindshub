@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Conteúdos da Disciplina: {{ $discipline->title }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('contents.createForm', ['id' => $discipline->id]) }}" class="btn btn-primary mb-3">Adicionar Novo Conteúdo</a>

    @if($discipline->contents->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Arquivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($discipline->contents as $content)
                <tr>
                    <td>{{ $content->title }}</td>
                    <td><a href="{{ asset($content->file_path) }}" target="_blank">Visualizar</a></td>
                    <td>
                        <a href="{{ route('contents.editContent', $content->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        
                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Deseja excluir este conteúdo?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Esta disciplina ainda não possui conteúdos.</p>
    @endif
</div>
@endsection
