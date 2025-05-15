@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Avaliações</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Disciplina</th>
                <th>Nota</th>
                <th>Comentário</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->user->name }}</td>
                    <td>{{ $evaluation->discipline->title }}</td>
                    <td>{{ $evaluation->score }}</td>
                    <td>{{ $evaluation->comment }}</td>
                    <td>{{ $evaluation->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection