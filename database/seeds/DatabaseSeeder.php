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
         $this->call([


             PermissionsTableSeeder::class,
             RolesTableSeeder::class,
             UsersTableSeeder::class,
             CategoriesTableSeeder::class,
             ProductsTableSeeder::class
         ]);



    }


}
