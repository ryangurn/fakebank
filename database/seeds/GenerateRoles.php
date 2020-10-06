<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GenerateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'staff']);
        Role::firstOrCreate(['name' => 'editor']);
        Role::firstOrCreate(['name' => 'reporter']);
        Role::firstOrCreate(['name' => 'customer']);
        Role::firstOrCreate(['name' => 'banker']);
    }
}
