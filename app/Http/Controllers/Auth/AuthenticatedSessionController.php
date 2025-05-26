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

        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'password' => 'Senha incorreta',
            ])->withInput();
        }

        $request->session()->regenerate();

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', '!=', Session::getId())
            ->delete();

        // Verifica se é o primeiro login
        if ($user->first_login) {
            $user->gainXp(1);
            $user->first_login = false;
            $user->save();
        }

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
