<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsRH
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
        if (in_array('9', Auth::user()->roles->pluck('id')->toArray())) {

            if (Auth::user()->roles->where('id', 9)->first()->pivot->activiter == 1) {
                return $next($request);
            }  else if (Auth::user()->roles->where('id', 3)->first()->pivot->activiter == 1) {
                return redirect()->route('conge_employe')->with('info', 'Vous êtes connecté en tant qu\'employe');
            } else if (Auth::user()->roles->where('id', 2)->first()->pivot->activiter == 1) {
                return redirect()->route('home_referent')->with('info', 'Vous êtes connecté en tant qu\'RH');
            } else if (Auth::user()->roles->where('id', 5)->first()->pivot->activiter == 1) {
                return redirect()->route('home_manager')->with('info', 'Vous êtes connecté en tant que manager');
            } elseif (Auth::user()->roles) {
                return redirect()->route('conge_employe')->with('info', 'Vous êtes connecté en tant qu\'employe');
            } else {
                return redirect()->route('sign-in');
            }

        }


        // // utilisation de contains() sur un objet
        // if (Auth::user()->roles->pluck('id')->contains('3')) {
        //     if (Auth::user()->roles->where('id', 3)->first()->pivot->activiter == 1) {
        //         return redirect()->route('conge_employe')->with('info', 'Vous êtes connecté en tant qu\'employe');
        //     } else {
        //         return redirect()->route('sign-in');
        //     }
        // }
    }
}
