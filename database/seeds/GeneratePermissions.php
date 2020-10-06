<?php

use \Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class GeneratePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate(['name' => 'create user']);
        Permission::firstOrCreate(['name' => 'read user']);
        Permission::firstOrCreate(['name' => 'update user']);
        Permission::firstOrCreate(['name' => 'delete user']);
        Permission::firstOrCreate(['name' => 'access user']);
        Permission::firstOrCreate(['name' => 'send temporary password']);

        Permission::firstOrCreate(['name' => 'create bank']);
        Permission::firstOrCreate(['name' => 'read bank']);
        Permission::firstOrCreate(['name' => 'update bank']);
        Permission::firstOrCreate(['name' => 'delete bank']);
        Permission::firstOrCreate(['name' => 'access bank']);
        Permission::firstOrCreate(['name' => 'activate bank']);

        Permission::firstOrCreate(['name' => 'create account']);
        Permission::firstOrCreate(['name' => 'read account']);
        Permission::firstOrCreate(['name' => 'update account']);
        Permission::firstOrCreate(['name' => 'delete account']);
        Permission::firstOrCreate(['name' => 'access account']);
        Permission::firstOrCreate(['name' => 'generate transactions']);

        Permission::firstOrCreate(['name' => 'create transaction']);
        Permission::firstOrCreate(['name' => 'read transaction']);
        Permission::firstOrCreate(['name' => 'update transaction']);
        Permission::firstOrCreate(['name' => 'delete transaction']);
        Permission::firstOrCreate(['name' => 'access transaction']);

        Permission::firstOrCreate(['name' => 'create template']);
        Permission::firstOrCreate(['name' => 'read template']);
        Permission::firstOrCreate(['name' => 'update template']);
        Permission::firstOrCreate(['name' => 'delete template']);
        Permission::firstOrCreate(['name' => 'access template']);

        Permission::firstOrCreate(['name' => 'create variable']);
        Permission::firstOrCreate(['name' => 'read variable']);
        Permission::firstOrCreate(['name' => 'update variable']);
        Permission::firstOrCreate(['name' => 'delete variable']);
        Permission::firstOrCreate(['name' => 'access variable']);

        Permission::firstOrCreate(['name' => 'create route']);
        Permission::firstOrCreate(['name' => 'read route']);
        Permission::firstOrCreate(['name' => 'update route']);
        Permission::firstOrCreate(['name' => 'delete route']);
        Permission::firstOrCreate(['name' => 'access route']);

        Permission::firstOrCreate(['name' => 'create file']);
        Permission::firstOrCreate(['name' => 'update file']);
        Permission::firstOrCreate(['name' => 'read file']);
        Permission::firstOrCreate(['name' => 'delete file']);
        Permission::firstOrCreate(['name' => 'access file']);

        Permission::firstOrCreate(['name' => 'access log']);
    }
}
