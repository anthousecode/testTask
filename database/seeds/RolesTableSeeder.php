<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $role = Role::create(['name' => 'SuperAdmin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'AdminManager']);
        $role->givePermissionTo('add product','edit product');

        Role::create(['name' => 'User']);

    }
}
