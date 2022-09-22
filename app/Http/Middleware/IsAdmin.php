<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if (in_array('32', Auth::user()->roles->pluck('id')->toArray()) ) {
            // dd(5);
            // verifye if the role with id 5 has activer set to 1

            if (Auth::user()->roles->where('id', 32)->first()->pivot->activiter == 1) {
                // dd(Auth::user()->roles->where('id', 5)->first()->pivot);
                return $next($request);
            }else if (Auth::user()->roles->where('id', 33)->first()->pivot->activiter == 1) {
                return redirect()->route('conge_employe')->with('info', 'Vous êtes connecté en tant qu\'employe');
            } else if (Auth::user()->roles->where('id', 39)->first()->pivot->activiter == 1) {
                return redirect()->route('home_RH')->with('info', 'Vous êtes connecté en tant qu\'RH');
            } else if (Auth::user()->roles->where('id', 40)->first()->pivot->activiter == 1) {
                return redirect()->route('home_referent')->with('info', 'Vous êtes connecté en tant que manager');
            }else if (Auth::user()->roles->where('id', 35)->first()->pivot->activiter == 1) {
                return redirect()->route('home_manager')->with('info', 'Vous êtes connecté en tant que manager');
            } elseif (Auth::user()->roles) {
                return redirect()->route('conge_employe')->with('info', 'Vous êtes connecté en tant qu\'employe');
            } else {
                return redirect()->route('sign-in');
            }
        }
    }
}

