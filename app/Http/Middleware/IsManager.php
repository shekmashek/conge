<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsManager
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
        if (in_array('5', Auth::user()->roles->pluck('id')->toArray()) ) {
            // dd(5);
            // verifye if the role with id 5 has activer set to 1

            if (Auth::user()->roles->where('id', 5)->first()->pivot->activiter == 1) {
                // dd(Auth::user()->roles->where('id', 5)->first()->pivot);
                return $next($request);
            }
        }


        // utilisation de contains() sur un objet
        if (Auth::user()->roles->pluck('id')->contains('3')) {

            if (Auth::user()->roles->where('id', 3)->first()->pivot->activiter == 1) {
                return redirect()->route('conge_employe')->with('info', 'Vous êtes connecté en tant qu\'employe');
            } else {
                # code...
            }


        }

    }
}
