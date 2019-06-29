<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\UserRole;
use App\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        echo PHP_EOL , 'cleaning old data....';

        DB::statement("SET foreign_key_checks=0");

        User::truncate();
        Role::truncate();
        UserRole::truncate();
        Permission::truncate();
        DB::table('roles_permissions')->truncate();
        DB::table('users_permissions')->truncate();

        DB::statement("SET foreign_key_checks=1");

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UsersTableSeeder::class);

    }
}
