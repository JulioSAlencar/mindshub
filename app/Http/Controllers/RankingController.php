<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{

    public function index()
    {
        // Ranking completo
        $todosUsuarios = User::whereIn('role', ['student', 'teacher'])
                            ->orderByDesc('xp')
                            ->get();

        // Top 10
        $top10 = $todosUsuarios->take(10);

        // Usuário logado
        $usuarioLogado = Auth::user();

        // Verifica a posição do usuário logado
        $posicaoUsuarioLogado = $todosUsuarios->search(function ($user) use ($usuarioLogado) {
            return $user->id === $usuarioLogado->id;
        });

        // A posição começa do zero, então somamos 1
        $posicaoUsuarioLogado = $posicaoUsuarioLogado !== false ? $posicaoUsuarioLogado + 1 : null;

        return view('ranking.global', compact('top10', 'usuarioLogado', 'posicaoUsuarioLogado'));
    }

}
