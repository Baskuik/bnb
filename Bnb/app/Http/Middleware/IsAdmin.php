<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        //kijkt of gebruiker is ingelogd zo niet word je naar login gestuurd
        if (!Auth::check()) {
            return redirect('/login');
        }
        //kijkt of is_admin true is als dat niet zo is word je terug gestuurd naar de home page met foutmelding 
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Deze pagina is alleen toegankelijk voor admins.');
        }

        return $next($request);
    }
}
