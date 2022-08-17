<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsReferent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('sign-in');
        }

        // utilisation de in_array() sur le tableau des roles de l'utilisateur connecté
        if (in_array('2', Auth::user()->roles->pluck('id')->toArray())) {
            return $next($request);
        }


        // utilisation de contains() sur un objet
        if (Auth::user()->roles->pluck('id')->contains('3')) {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits pour accéder à cette page');
        }
    }
}
