<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Gestionnaire
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['gestionnaire', 'admin'], true)) {
            return $next($request);
        }
        abort(403, 'Accès réservé aux gestionnaires.');
    }
}
