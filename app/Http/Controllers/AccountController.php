<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function requestDeletion(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Verifica se confirmação foi enviada
        if (!$request->has('confirm_delete')) {
            return back()->with('confirm_delete', true);
        }

        // Atualiza o usuário
        $user->update([
            'is_pending_deletion' => true,
            'deletion_requested_at' => now(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Sua conta foi marcada para exclusão e será apagada em 90 dias.');
    }
}
