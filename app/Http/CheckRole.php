<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        $roles = explode('|', $roles);

        $userRole = auth()->user()->role;


        if (!in_array($userRole, $roles)) {
            abort(403, 'Acesso não autorizado');
        }

<<<<<<< Updated upstream
        $user = Auth::user();

        // Converte a string de funções em um array
        $rolesArray = explode(',', $roles);

        if (in_array($user->role, $rolesArray)) {
            return $next($request);
        }

        abort(403, 'Acesso não autorizado');
=======
        return $next($request);
>>>>>>> Stashed changes
    }
}
