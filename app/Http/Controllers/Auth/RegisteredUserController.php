<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Medal;
use App\Models\User;
use App\Models\UserMedal;
use App\Notifications\MedalAwardedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create(Request $request, $role = null)
    {
        if (!in_array($role, ['student', 'teacher'])) {
            abort(404);
        }
        return view('auth.register', ['role' => $role]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:student,teacher',
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'xp' => 1,  // Inicia com 1 XP
            'level' => 1, // Inicia no nível 1
            'first_login' => true,
        ]);

        // Atribui a medalha "Início"
        // Esta medalha deve ter condition_type='level' e condition_value=1
        $startMedal = Medal::where('name', 'Início')->first();

        if ($startMedal) {
            $user->awardMedal($startMedal);
            if ($startMedal->icon) {
                Session::push('awarded_medals_messages', 'Você ganhou a medalha "' . $startMedal->name . '"! <img src="'.asset($startMedal->icon).'" alt="'.$startMedal->name.'" width="32">');
            } else {
                Session::push('awarded_medals_messages', 'Você ganhou a medalha "' . $startMedal->name . '"!');
            }
        }

        // Alternativamente, a medalha de nível 1 seria pega pelo $user->checkAndAwardNewMedals()
        // se chamada aqui, mas atribuir explicitamente a "Início" é mais claro.
        // $user->checkAndAwardNewMedals(); // Poderia ser chamado aqui também.

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
