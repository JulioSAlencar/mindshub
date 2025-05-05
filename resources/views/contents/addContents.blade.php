@extends('layouts.app')

@section('content')

<!-- Formulário de envio -->
<form method="POST" action="{{ route('contents.store', $discipline->id) }}" enctype="multipart/form-data" class="mt-6">
    @csrf
    <input type="text" name="title" placeholder="Título do conteúdo" required class="w-full p-2 rounded mb-2">
    <input type="file" name="file" required class="w-full p-2 rounded mb-4">
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-800 transition">Enviar</button>
</form>


@endsection