<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  ((Auth::user()->rol->name == "administrator") || (Auth::user()->rol->name == "agente"))) {
            return $next($request);
        }

        return redirect('/login');
       // return $next($request);
    }
}
