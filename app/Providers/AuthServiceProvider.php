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

        // verification des roles de l'utilisateur connecté:
        // les conditions vérifient les nom de roles ( roles_name ) puisque l'id donne une référence ambiguë dans la requête.
        Gate::define('isReferent', function ($user) {

            return $user = User::where('id', Auth::user()->id)->whereHas('roles', function ($query) {
                $query->where('role_name', 'referent');
                // $query->where('id', 2);
                // where pivot activiter = 1
                $query->where('role_users.activiter', 1);
            })->exists();
        });


        Gate::define('isManager', function ($user) {

            return $user = User::where('id', Auth::user()->id)->whereHas('roles', function ($query) {
                $query->where('role_name', 'manager');
                // $query->where('role_name', 'employe')->whereHas('role_users', function ($query) {
                //     $query->where('role_id', 3)->where('activiter', 1);
                // });
                $query->where('role_users.activiter', 1);
            })->exists();
        });

        Gate::define('isEmploye', function ($user) {

            return $user = User::where('id', Auth::user()->id)->whereHas('roles', function ($query) {

                    // query where the role_name is stagiaire and role_users pivot with role_id = 3 has activiter = 1
                    $query->where('role_name', 'employe')->whereHas('role_users', function ($query) {
                    $query->where('role_users.activiter', 1);

                });
            })->exists();
        });

        // -----RH-----
        Gate::define('isRH', function ($user) {

            return $user = User::where('id', Auth::user()->id)->whereHas('roles', function ($query) {
                $query->where('role_name', 'RH');
                $query->where('role_users.activiter', 1);
            })->exists();

        });


    }
}
