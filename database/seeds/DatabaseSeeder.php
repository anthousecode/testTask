<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
                'name' => 'Super admin'
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin manager'
        ]);
        DB::table('roles')->insert([
            'name' => 'User'
        ]);
        DB::table('permissoins')->insert([
            'name' => 'create category'
        ]);
        DB::table('permissoins')->insert([
            'name' => 'create category'
        ]);



    }


}
