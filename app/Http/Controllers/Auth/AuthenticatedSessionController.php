<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Usuário não cadastrado',
            ])->withInput();
        }

        // Checar se está pendente de exclusão
        if ($user->is_pending_deletion) {
            $daysSinceRequest = now()->diffInDays($user->deletion_requested_at);
            if ($daysSinceRequest >= 90) {
                return back()->withErrors([
                    'email' => 'Conta desativada permanentemente após 90 dias.',
                ]);
            }

            // Reativar a conta
            $user->update([
                'is_pending_deletion' => false,
                'deletion_requested_at' => null,
            ]);
        }

        // Verificar credenciais
        if (!Auth::attempt($credentials, $remember)) {
            $user->increment('failed_attempts');

            if ($user->failed_attempts >= 5) {
                Session::flash('suggest_password_reset', true);
            }

            return back()->withErrors([
                'password' => 'Senha incorreta',
            ])->withInput();
        }

        // Login bem-sucedido
        $request->session()->regenerate();
        $user->update(['failed_attempts' => 0]);

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', '!=', Session::getId())
            ->delete();

        return redirect()->intended(route('dashboard', absolute: false));
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
