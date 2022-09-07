<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // -----referent-----
        Gate::define('isReferent', function ($user) {

            return $user=User::where('id',Auth::user()->id)->whereHas('roles', function ($query) {
                $query->where('role_name', 'referent');
            })->exists();

        });

        // -----RH-----
        Gate::define('isRH', function ($user) {

            return $user=User::where('id',Auth::user()->id)->whereHas('roles', function ($query) {
                $query->where('role_name', 'RH');
            })->exists();

        });
    }
}
