@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold text- mb-4 mt-8 flex items-center gap-2">
  🏆 Ranking - Global
</h2>

<div class="bg-gray-900 text-white rounded-xl p-6 shadow-md w-full max-w-2xl">
  <ul id="ranking-turma" class="space-y-3">
    @foreach ($top10 as $index => $usuario)
      <li class="flex justify-between items-center">
        <div class="flex items-center gap-2">
          <span class="text-xl 
            @if($index == 0) text-yellow-400 
            @elseif($index == 1) text-blue-400 
            @elseif($index == 2) text-orange-400 
            @else text-gray-400 
            @endif">
            @if($index == 0) 👑 #1
            @elseif($index == 1) 🥈 #2
            @elseif($index == 2) 🥉 #3
            @else #{{ $index + 1 }}
            @endif
          </span>
          <span>{{ $usuario->name }}</span>
        </div>
        <span class="text-sm text-gray-300">{{ $usuario->xp }} xp</span>
      </li>
    @endforeach
  </ul>

  @if ($posicaoUsuarioLogado > 10)
    <div class="mt-6 border-t border-gray-700 pt-4 text-sm text-gray-400">
      Você está na <strong>#{{ $posicaoUsuarioLogado }}</strong> posição com <strong>{{ $usuarioLogado->xp }} xp</strong>.
    </div>
  @endif
</div>

@endsection
