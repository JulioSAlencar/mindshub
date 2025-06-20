@extends('layouts.app')

@section('title', $discipline->title)

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden mt-10 p-6 flex flex-col md:flex-row items-center gap-6">
        <div class="flex-shrink-0">
            <img class="w-48 h-48 object-cover rounded-lg shadow-sm"
            src="{{ $discipline->image ? asset('assets/disciplines/' . $discipline->image)
            : asset('assets/disciplines/default_discipline.png') }}">
        </div>
        <div class="flex-1 space-y-4">
            <div class="flex">
                <h1 class="text-2xl font-bold text-gray-800">{{ $discipline->title }}</h1>
            </div>
            <h5 class="text-gray-600">{{ $discipline->description }}</h5>
            <p class="text-sm text-gray-500">Professor: <span class="font-medium text-gray-700">{{ $disciplineOwner['name'] }}</span></p>
            <p class="text-sm text-gray-500">{{ count($discipline->users) }} pessoas se inscreveram</p>
            @cannot('is-creator', $discipline)
                <form action="/disciplines/join/{{ $discipline->id }}" method="POST">
                    @csrf
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    >
                        Inscrever-se
                    </button>
                </form>
            @else
                <p class="text-green-600 font-semibold">Você é o criador desta disciplina.</p>
            @endcannot
        </div>
    </div>
@endsection
