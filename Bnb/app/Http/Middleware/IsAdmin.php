<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Deze pagina is alleen toegankelijk voor admins.');
        }

        return $next($request);
    }
}