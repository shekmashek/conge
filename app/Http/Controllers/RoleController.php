<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $ids = $user->roles()->allRelatedIds();
        foreach ($ids as $id) {
            if ($id == (int)$request->input('role_id')) {
                $user->roles()->updateExistingPivot($id, ['activiter' => 1]);
            } else {
                $user->roles()->updateExistingPivot($id, ['activiter' => 0]);
            }
        }
        $roles_user = $user->roles->pluck('id');
        if ($roles_user->contains(32) && $user->roles->where('id',32)->first()->pivot->activiter == 1) {
            // return '/admin/home';
            return redirect()->route('admin.home');
        } elseif ($roles_user->contains(35) && $user->roles->where('id',35)->first()->pivot->activiter == 1) {
            // return '/home_manager';
            return redirect()->route(('home_manager'));
        } elseif ($roles_user->contains(39) && $user->roles->where('id',39)->first()->pivot->activiter == 1) {
            // return '/home_RH';
            return redirect()->route(('home_RH'));
        } elseif ($roles_user->contains(33) && $user->roles->where('id',33)->first()->pivot->activiter == 1) {
            // return '/conge_employe';
            return redirect()->route('conge_employe');
        } elseif ($roles_user->contains(40) && $user->roles->where('id',40)->first()->pivot->activiter == 1) {
            // return '/home_referent';
            return redirect()->route('home_referent');

        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
