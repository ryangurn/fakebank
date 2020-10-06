<?php

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        // arrays
        $adminArr = [];

        // get roles for assignment
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $reporter = Role::firstOrCreate(['name' => 'reporter']);
        $customer = Role::firstOrCreate(['name' => 'customer']);
        $banker = Role::firstOrCreate(['name' => 'banker']);

        $user_create = Permission::firstOrCreate(['name' => 'create user']);
        $user_read = Permission::firstOrCreate(['name' => 'read user']);
        $user_update = Permission::firstOrCreate(['name' => 'update user']);
        $user_delete = Permission::firstOrCreate(['name' => 'delete user']);
        $user_access = Permission::firstOrCreate(['name' => 'access user']);
        $user_tmp = Permission::firstOrCreate(['name' => 'send temporary password']);
        // user assignments
        $adminArr[] = $user_create;
        $adminArr[] = $user_read;
        $adminArr[] = $user_update;
        $adminArr[] = $user_delete;
        $adminArr[] =$user_access;
        $adminArr[] = $user_tmp;

        $bank_create = Permission::firstOrCreate(['name' => 'create bank']);
        $bank_read = Permission::firstOrCreate(['name' => 'read bank']);
        $bank_update = Permission::firstOrCreate(['name' => 'update bank']);
        $bank_delete = Permission::firstOrCreate(['name' => 'delete bank']);
        $bank_access = Permission::firstOrCreate(['name' => 'access bank']);
        $bank_activate = Permission::firstOrCreate(['name' => 'activate bank']);
        // bank assignments
        $adminArr[] = $bank_create;
        $adminArr[] = $bank_read;
        $adminArr[] = $bank_update;
        $adminArr[] = $bank_delete;
        $adminArr[] = $bank_access;
        $adminArr[] = $bank_activate;


        $account_create = Permission::firstOrCreate(['name' => 'create account']);
        $account_read = Permission::firstOrCreate(['name' => 'read account']);
        $account_update = Permission::firstOrCreate(['name' => 'update account']);
        $account_delete = Permission::firstOrCreate(['name' => 'delete account']);
        $account_access = Permission::firstOrCreate(['name' => 'access account']);
        $account_generate = Permission::firstOrCreate(['name' => 'generate transactions']);
        // account assignments
        $adminArr[] = $account_create;
        $adminArr[] = $account_read;
        $adminArr[] = $account_update;
        $adminArr[] = $account_delete;
        $adminArr[] = $account_access;
        $adminArr[] = $account_generate;

        $transaction_create = Permission::firstOrCreate(['name' => 'create transaction']);
        $transaction_read = Permission::firstOrCreate(['name' => 'read transaction']);
        $transaction_update = Permission::firstOrCreate(['name' => 'update transaction']);
        $transaction_delete = Permission::firstOrCreate(['name' => 'delete transaction']);
        $transaction_access = Permission::firstOrCreate(['name' => 'access transaction']);
        // transaction assignments
        $adminArr[] = $transaction_create;
        $adminArr[] = $transaction_read;
        $adminArr[] = $transaction_update;
        $adminArr[] = $transaction_delete;
        $adminArr[] = $transaction_access;

        $template_create = Permission::firstOrCreate(['name' => 'create template']);
        $template_read = Permission::firstOrCreate(['name' => 'read template']);
        $template_update = Permission::firstOrCreate(['name' => 'update template']);
        $template_delete = Permission::firstOrCreate(['name' => 'delete template']);
        $template_access = Permission::firstOrCreate(['name' => 'access template']);
        // template assignments
        $adminArr[] = $template_create;
        $adminArr[] = $template_read;
        $adminArr[] = $template_update;
        $adminArr[] = $template_delete;
        $adminArr[] = $template_access;

        $variable_create = Permission::firstOrCreate(['name' => 'create variable']);
        $variable_read = Permission::firstOrCreate(['name' => 'read variable']);
        $variable_update = Permission::firstOrCreate(['name' => 'update variable']);
        $variable_delete = Permission::firstOrCreate(['name' => 'delete variable']);
        $variable_access = Permission::firstOrCreate(['name' => 'access variable']);
        // variable assignments
        $adminArr[] = $variable_create;
        $adminArr[] = $variable_read;
        $adminArr[] = $variable_update;
        $adminArr[] = $variable_delete;
        $adminArr[] = $variable_access;

        $route_create = Permission::firstOrCreate(['name' => 'create route']);
        $route_read = Permission::firstOrCreate(['name' => 'read route']);
        $route_update = Permission::firstOrCreate(['name' => 'update route']);
        $route_delete = Permission::firstOrCreate(['name' => 'delete route']);
        $route_access = Permission::firstOrCreate(['name' => 'access route']);
        // route assignments
        $adminArr[] = $route_create;
        $adminArr[] = $route_read;
        $adminArr[] = $route_update;
        $adminArr[] = $route_delete;
        $adminArr[] = $route_access;

        $file_create = Permission::firstOrCreate(['name' => 'create file']);
        $file_update = Permission::firstOrCreate(['name' => 'update file']);
        $file_read = Permission::firstOrCreate(['name' => 'read file']);
        $file_delete = Permission::firstOrCreate(['name' => 'delete file']);
        $file_access = Permission::firstOrCreate(['name' => 'access file']);
        // file assignments
        $adminArr[] = $file_create;
        $adminArr[] = $file_update;
        $adminArr[] = $file_read;
        $adminArr[] = $file_delete;
        $adminArr[] = $file_access;

        $log_access = Permission::firstOrCreate(['name' => 'access log']);
        // log assignments
        $adminArr[] = $log_access;

            // sync permissions
        $admin->syncPermissions($adminArr);
    }
}
