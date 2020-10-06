<?php

use App\PermissionMeta;
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
        $adminArr = []; // fakebank administrator
        $staffArr = []; // fakebank it staff
        $editorArr = []; // fakebank template editor
        $reporterArr = []; // fakebank report proofer
        $customerArr = []; // access to the normal customer facing side
        $bankerArr = []; // fake support representative for the active bank

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

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $user_create->id, 'description' => 'The ability to create a new user']);
        PermissionMeta::firstOrCreate(['permission_id' => $user_read->id, 'description' => 'The ability to view a users information']);
        PermissionMeta::firstOrCreate(['permission_id' => $user_update->id, 'description' => 'The ability to update users']);
        PermissionMeta::firstOrCreate(['permission_id' => $user_delete->id, 'description' => 'The ability to delete users']);
        PermissionMeta::firstOrCreate(['permission_id' => $user_access->id, 'description' => 'The ability to view the logs for a user']);
        PermissionMeta::firstOrCreate(['permission_id' => $user_tmp->id, 'description' => 'The ability to issue a temporary password']);

        // user assignments
        // admin
        $adminArr[] = $user_create;
        $adminArr[] = $user_read;
        $adminArr[] = $user_update;
        $adminArr[] = $user_delete;
        $adminArr[] = $user_access;
        $adminArr[] = $user_tmp;
        // staff
        $staffArr [] = $user_read;
        $staffArr [] = $user_access;
        $staffArr [] = $user_tmp;
        // editor - (none)
        // reporter - (none)

        $bank_create = Permission::firstOrCreate(['name' => 'create bank']);
        $bank_read = Permission::firstOrCreate(['name' => 'read bank']);
        $bank_update = Permission::firstOrCreate(['name' => 'update bank']);
        $bank_delete = Permission::firstOrCreate(['name' => 'delete bank']);
        $bank_access = Permission::firstOrCreate(['name' => 'access bank']);
        $bank_activate = Permission::firstOrCreate(['name' => 'activate bank']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $bank_create->id, 'description' => 'The ability to create a new bank']);
        PermissionMeta::firstOrCreate(['permission_id' => $bank_read->id, 'description' => 'The ability to view a banks information']);
        PermissionMeta::firstOrCreate(['permission_id' => $bank_update->id, 'description' => 'The ability to update banks']);
        PermissionMeta::firstOrCreate(['permission_id' => $bank_delete->id, 'description' => 'The ability to delete banks']);
        PermissionMeta::firstOrCreate(['permission_id' => $bank_access->id, 'description' => 'The ability to view the logs for a bank']);
        PermissionMeta::firstOrCreate(['permission_id' => $bank_activate->id, 'description' => 'The ability to activate/de-activate a bank']);

        // bank assignments
        // admin
        $adminArr[] = $bank_create;
        $adminArr[] = $bank_read;
        $adminArr[] = $bank_update;
        $adminArr[] = $bank_delete;
        $adminArr[] = $bank_access;
        $adminArr[] = $bank_activate;
        // staff
        $staffArr [] = $bank_create;
        $staffArr [] = $bank_read;
        $staffArr [] = $bank_update;
        $staffArr [] = $bank_delete;
        $staffArr [] = $bank_access;
        $staffArr [] = $bank_activate;
        // editor
        $editorArr [] = $bank_read;
        $editorArr [] = $bank_activate;
        // reporter - (none)


        $account_create = Permission::firstOrCreate(['name' => 'create account']);
        $account_read = Permission::firstOrCreate(['name' => 'read account']);
        $account_update = Permission::firstOrCreate(['name' => 'update account']);
        $account_delete = Permission::firstOrCreate(['name' => 'delete account']);
        $account_access = Permission::firstOrCreate(['name' => 'access account']);
        $account_generate = Permission::firstOrCreate(['name' => 'generate transactions']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $account_create->id, 'description' => 'The ability to create a new account']);
        PermissionMeta::firstOrCreate(['permission_id' => $account_read->id, 'description' => 'The ability to view a accounts information']);
        PermissionMeta::firstOrCreate(['permission_id' => $account_update->id, 'description' => 'The ability to update accounts']);
        PermissionMeta::firstOrCreate(['permission_id' => $account_delete->id, 'description' => 'The ability to delete accounts']);
        PermissionMeta::firstOrCreate(['permission_id' => $account_access->id, 'description' => 'The ability to view the logs for a account']);
        PermissionMeta::firstOrCreate(['permission_id' => $account_generate->id, 'description' => 'The ability to generate transactions for an account']);

        // account assignments
        // admin
        $adminArr[] = $account_create;
        $adminArr[] = $account_read;
        $adminArr[] = $account_update;
        $adminArr[] = $account_delete;
        $adminArr[] = $account_access;
        $adminArr[] = $account_generate;
        // staff
        $staffArr [] = $account_create;
        $staffArr [] = $account_read;
        $staffArr [] = $account_update;
        $staffArr [] = $account_delete;
        $staffArr [] = $account_access;
        $staffArr [] = $account_generate;
        // editor
        $editorArr [] = $account_read;
        // reporter - (none)
        // banker
        $bankerArr [] = $account_read;

        $transaction_create = Permission::firstOrCreate(['name' => 'create transaction']);
        $transaction_read = Permission::firstOrCreate(['name' => 'read transaction']);
        $transaction_update = Permission::firstOrCreate(['name' => 'update transaction']);
        $transaction_delete = Permission::firstOrCreate(['name' => 'delete transaction']);
        $transaction_access = Permission::firstOrCreate(['name' => 'access transaction']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $transaction_create->id, 'description' => 'The ability to create a new transaction']);
        PermissionMeta::firstOrCreate(['permission_id' => $transaction_read->id, 'description' => 'The ability to view a transactions information']);
        PermissionMeta::firstOrCreate(['permission_id' => $transaction_update->id, 'description' => 'The ability to update transactions']);
        PermissionMeta::firstOrCreate(['permission_id' => $transaction_delete->id, 'description' => 'The ability to delete transactions']);
        PermissionMeta::firstOrCreate(['permission_id' => $transaction_access->id, 'description' => 'The ability to view the logs for a transaction']);

        // transaction assignments
        // admin
        $adminArr[] = $transaction_create;
        $adminArr[] = $transaction_read;
        $adminArr[] = $transaction_update;
        $adminArr[] = $transaction_delete;
        $adminArr[] = $transaction_access;
        // staff
        $staffArr [] = $transaction_create;
        $staffArr [] = $transaction_read;
        $staffArr [] = $transaction_update;
        $staffArr [] = $transaction_delete;
        $staffArr [] = $transaction_access;
        // editor
        $editorArr [] = $transaction_read;
        // reporter - (none)
        // banker
        $bankerArr [] = $transaction_read;


        $template_create = Permission::firstOrCreate(['name' => 'create template']);
        $template_read = Permission::firstOrCreate(['name' => 'read template']);
        $template_update = Permission::firstOrCreate(['name' => 'update template']);
        $template_delete = Permission::firstOrCreate(['name' => 'delete template']);
        $template_access = Permission::firstOrCreate(['name' => 'access template']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $template_create->id, 'description' => 'The ability to create a new template']);
        PermissionMeta::firstOrCreate(['permission_id' => $template_read->id, 'description' => 'The ability to view a templates information']);
        PermissionMeta::firstOrCreate(['permission_id' => $template_update->id, 'description' => 'The ability to update templates']);
        PermissionMeta::firstOrCreate(['permission_id' => $template_delete->id, 'description' => 'The ability to delete templates']);
        PermissionMeta::firstOrCreate(['permission_id' => $template_access->id, 'description' => 'The ability to view the logs for a template']);

        // template assignments
        // admin
        $adminArr[] = $template_create;
        $adminArr[] = $template_read;
        $adminArr[] = $template_update;
        $adminArr[] = $template_delete;
        $adminArr[] = $template_access;
        // staff
        $staffArr [] = $template_read;
        $staffArr [] = $template_access;
        // editor
        $editorArr [] = $template_create;
        $editorArr [] = $template_read;
        $editorArr [] = $template_update;
        $editorArr [] = $template_delete;
        // reporter - (none)

        $variable_create = Permission::firstOrCreate(['name' => 'create variable']);
        $variable_read = Permission::firstOrCreate(['name' => 'read variable']);
        $variable_update = Permission::firstOrCreate(['name' => 'update variable']);
        $variable_delete = Permission::firstOrCreate(['name' => 'delete variable']);
        $variable_access = Permission::firstOrCreate(['name' => 'access variable']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $variable_create->id, 'description' => 'The ability to create a new variable']);
        PermissionMeta::firstOrCreate(['permission_id' => $variable_read->id, 'description' => 'The ability to view a variables information']);
        PermissionMeta::firstOrCreate(['permission_id' => $variable_update->id, 'description' => 'The ability to update variables']);
        PermissionMeta::firstOrCreate(['permission_id' => $variable_delete->id, 'description' => 'The ability to delete variables']);
        PermissionMeta::firstOrCreate(['permission_id' => $variable_access->id, 'description' => 'The ability to view the logs for a variable']);

        // variable assignments
        // admin
        $adminArr[] = $variable_create;
        $adminArr[] = $variable_read;
        $adminArr[] = $variable_update;
        $adminArr[] = $variable_delete;
        $adminArr[] = $variable_access;
        // staff
        $staffArr [] = $variable_read;
        $staffArr [] = $variable_access;
        // editor
        $editorArr [] = $variable_create;
        $editorArr [] = $variable_read;
        $editorArr [] = $variable_update;
        $editorArr [] = $variable_delete;
        // reporter
        $reporterArr [] = $variable_read;

        $route_create = Permission::firstOrCreate(['name' => 'create route']);
        $route_read = Permission::firstOrCreate(['name' => 'read route']);
        $route_update = Permission::firstOrCreate(['name' => 'update route']);
        $route_delete = Permission::firstOrCreate(['name' => 'delete route']);
        $route_access = Permission::firstOrCreate(['name' => 'access route']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $route_create->id, 'description' => 'The ability to create a new route']);
        PermissionMeta::firstOrCreate(['permission_id' => $route_read->id, 'description' => 'The ability to view a routes information']);
        PermissionMeta::firstOrCreate(['permission_id' => $route_update->id, 'description' => 'The ability to update routes']);
        PermissionMeta::firstOrCreate(['permission_id' => $route_delete->id, 'description' => 'The ability to delete routes']);
        PermissionMeta::firstOrCreate(['permission_id' => $route_access->id, 'description' => 'The ability to view the logs for a route']);

        // route assignments
        // admin
        $adminArr[] = $route_create;
        $adminArr[] = $route_read;
        $adminArr[] = $route_update;
        $adminArr[] = $route_delete;
        $adminArr[] = $route_access;
        // staff
        $staffArr [] = $route_read;
        $staffArr [] = $route_access;
        // editor
        $editorArr [] = $route_create;
        $editorArr [] = $route_read;
        $editorArr [] = $route_update;
        $editorArr [] = $route_delete;
        // reporter - (none)

        $file_create = Permission::firstOrCreate(['name' => 'create file']);
        $file_update = Permission::firstOrCreate(['name' => 'update file']);
        $file_read = Permission::firstOrCreate(['name' => 'read file']);
        $file_delete = Permission::firstOrCreate(['name' => 'delete file']);
        $file_access = Permission::firstOrCreate(['name' => 'access file']);

        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $file_create->id, 'description' => 'The ability to create a new file']);
        PermissionMeta::firstOrCreate(['permission_id' => $file_update->id, 'description' => 'The ability to view a files information']);
        PermissionMeta::firstOrCreate(['permission_id' => $file_read->id, 'description' => 'The ability to update files']);
        PermissionMeta::firstOrCreate(['permission_id' => $file_delete->id, 'description' => 'The ability to delete files']);
        PermissionMeta::firstOrCreate(['permission_id' => $file_access->id, 'description' => 'The ability to view the logs for a file']);

        // file assignments
        // admin
        $adminArr[] = $file_create;
        $adminArr[] = $file_update;
        $adminArr[] = $file_read;
        $adminArr[] = $file_delete;
        $adminArr[] = $file_access;
        // staff
        $staffArr [] = $file_read;
        $staffArr [] = $file_access;
        // editor
        $editorArr [] = $file_create;
        $editorArr [] = $file_update;
        $editorArr [] = $file_read;
        $editorArr [] = $file_delete;
        // reporter - (none)

        $log_access = Permission::firstOrCreate(['name' => 'access log']);
        // descriptions
        PermissionMeta::firstOrCreate(['permission_id' => $log_access->id, 'description' => 'The ability to view the logs for the entire system']);

        // log assignments
        // admin
        $adminArr[] = $log_access;
        // staff
        $staffArr [] = $log_access;
        // reporter
        $reporterArr [] = $log_access;

        // sync permissions
        $admin->syncPermissions($adminArr);
        $staff->syncPermissions($staffArr);
        $editor->syncPermissions($editorArr);
        $reporter->syncPermissions($reporterArr);
        $customer->syncPermissions($customerArr);
        $banker->syncPermissions($bankerArr);
    }
}
