<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenerateRoles::class);
        $this->call(GeneratePermissions::class);
        // $this->call(UsersTableSeeder::class);
    }
}
