@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Materiais Didáticos</h1>
  <ul>
    @foreach($materials as $material)
      <li>{{ $material->title }} - <a href="{{ asset('storage/' . $material->path) }}" target="_blank">Abrir</a></li>
    @endforeach
  </ul>
</div>
@endsection