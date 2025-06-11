@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Feedbacks</h1>
  <ul>
    @foreach($feedbacks as $feedback)
      <li>{{ $feedback->content }} - {{ $feedback->created_at->format('d/m/Y') }}</li>
    @endforeach
  </ul>
</div>
@endsection