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
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Converte "student|teacher" em array ['student', 'teacher']
        $rolesArray = explode('|', $roles);

        $userRole = Auth::user()->role;

        if (!in_array($userRole, $rolesArray)) {
            abort(403, 'Acesso não autorizado');
        }

        return $next($request);
    }
}
