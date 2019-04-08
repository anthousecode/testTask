<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


//        $permission = Permission::create(['name' => 'create category']);
//        $permission = Permission::create(['name' => 'edit post']);
//        $role = Role::findById(1);
//        $permission = Permission::findById(1);
        $superAdmin = Role::hasRole('Super Admin');
        if(auth()->user()->hasRole('Super Admin')){
            $superAdmin = givePermissionTo('');
        }
//        $permission->removeRole($role);
//        $role->revokePermissionTo($permission);
        return view('home');
    }
}
