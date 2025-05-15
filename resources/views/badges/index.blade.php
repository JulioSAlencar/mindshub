@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Emblemas</h1>
  <ul>
    @foreach($badges as $badge)
      <li>{{ $badge->name }} - {{ $badge->description }}</li>
    @endforeach
  </ul>
</div>
@endsection