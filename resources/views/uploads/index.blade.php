@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Uploads de Arquivos</h1>

    <form action="{{ route('uploads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Escolha um arquivo:</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <hr>

    <h3>Arquivos Enviados</h3>
    <ul class="list-group">
        @foreach($uploads as $upload)
            <li class="list-group-item">
                <a href="{{ asset('uploads/' . $upload->filename) }}" target="_blank">{{ $upload->filename }}</a>
                <small class="text-muted">enviado em {{ $upload->created_at->format('d/m/Y H:i') }}</small>
            </li>
        @endforeach
    </ul>
</div>
@endsection