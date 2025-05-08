@extends('layouts.app')

@section('title', $discipline->title)

@section('content')
    <div class="tudo">
        <div id="image-container">
            <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}"
            style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
        </div>
        <div id="info-container">
            <h1>{{ $discipline->title}}</h1>
            <h5>{{ $discipline->description }}</h5>
            <p>Professor: {{ $disciplineOwner['name'] }}</p>
            <p>{{ count($discipline->users) }} Pessoas se inscreveram</p>
            <form action="/disciplines/join/{{ $discipline->id }}" method="POST">
                @csrf
                <a href="{{ route('disciplines.join', ['id' => $discipline->id]) }}" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit();">
                    Inscrever-se
                </a>                
            </form>
            
        </div>
    </div>
@endsection