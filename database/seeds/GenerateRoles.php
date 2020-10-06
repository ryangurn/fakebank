<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\RoleMeta;

class GenerateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        RoleMeta::firstOrCreate(['role_id' => $admin->id, 'description' => 'Fakebank Administrative Privileges', 'long' => 'Administrative functions for accessing all portions of the Fakebank system. Any users with this role will not need to be assigned other roles since they will already have access to everything.']);

        $staff = Role::firstOrCreate(['name' => 'staff']);
        RoleMeta::firstOrCreate(['role_id' => $staff->id, 'description' => 'Fakebank Staff Privileges', 'long' => 'Staff functions allow the users to access critical managerial portions of this application, without having admin access']);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        RoleMeta::firstOrCreate(['role_id' => $editor->id, 'description' => 'Fakebank Template Editor Privileges', 'long' => 'Editors have the ability to access the portions of the fakebank system related to building the template front ends and accessing bank, account, & transaction data to ensure consistency']);

        $reporter = Role::firstOrCreate(['name' => 'reporter']);
        RoleMeta::firstOrCreate(['role_id' => $reporter->id, 'description' => 'Fakebank Scam Reporter Privileges', 'long' => 'The reporter role will allow any assigned users to access the reporting system, this will also centralize the information and communication logs for scam calls']);

        $customer = Role::firstOrCreate(['name' => 'customer']);
        RoleMeta::firstOrCreate(['role_id' => $customer->id, 'description' => 'Normal Consumer Privileges', 'long' => 'Customers have access to non administrative systems and can be an actor or scam-baiter who is accessing the bank itself.']);

        $banker = Role::firstOrCreate(['name' => 'banker']);
        RoleMeta::firstOrCreate(['role_id' => $banker->id, 'description' => 'Customer Support Representative Privileges', 'long' => 'A banker will essentially have the role of a customer support representative.']);
    }
}
