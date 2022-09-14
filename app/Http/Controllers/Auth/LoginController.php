<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectTo()
    {


        // le role_id 3 correspond au collaborateur
        // le role_id 5 correspond au manager

        $roles_user = Auth::user()->roles->pluck('id');
        if ($roles_user->contains(5) && Auth::user()->roles->where('id',5)->first()->pivot->activiter == 1) {
            return '/home_manager';
        } elseif ($roles_user->contains(9) && Auth::user()->roles->where('id',9)->first()->pivot->activiter == 1) {
            return '/home_RH';
        } elseif ($roles_user->contains(3) && Auth::user()->roles->where('id',3)->first()->pivot->activiter == 1) {
            return '/conge_employe';
        } elseif ($roles_user->contains(2) && Auth::user()->roles->where('id',2)->first()->pivot->activiter == 1) {
            return '/home_referent';
        } else {
            return '/home';
        }


        // return $next($request);
    }


}
