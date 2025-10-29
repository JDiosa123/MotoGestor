<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $rol)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->rol !== $rol) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
