<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Vérifie si l'utilisateur a le rôle requis
        if (!$user || $user->role !== $role) {
            abort(403, 'Accès interdit.');
        }

        return $next($request);
    }
}
