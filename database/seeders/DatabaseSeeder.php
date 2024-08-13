<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;








// use Illuminate\Database\Console\Seeds\WithoutModelEvents;



class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
    ];




public function run(): void
{
    // Insert roles
    $roleId = DB::table('roles')->insertGetId([
        'name' => 'sales-manager',
        'guard_name' => 'web',
    ]);

    // Insert permissions
    foreach ($this->permissions as $permission) {
        DB::table('permissions')->insert([
            'name' => $permission,
            'guard_name' => 'web',
        ]);
    }

    // Assign all permissions to the role
    $permissionIds = DB::table('permissions')->pluck('id')->toArray();
    foreach ($permissionIds as $permissionId) {
        DB::table('role_has_permissions')->insert([
            'role_id' => $roleId,
            'permission_id' => $permissionId,
        ]);
    }

    // Create a user and assign the role
    $userId = DB::table('users')->insertGetId([
        'name' => 'Prevail Ejimadudemo',
        'email' => 'testdemo@example.com',
        'password' => Hash::make('password'),
    ]);

    DB::table('model_has_roles')->insert([
        'role_id' => $roleId,
        'model_type' => 'App\Models\User',
        'model_id' => $userId,
    ]);
}


    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     foreach ($this->permissions as $permission) {
    //         Permission::create(['name' => $permission]);
    //     }

    //     // Create admin User and assign the role to him.
    //     $user = User::create([
    //         'name' => 'Prevail Ejimadudemo',
    //         'email' => 'testdemo@example.com',
    //         'password' => Hash::make('password')
    //     ]);

    //     $role = Role::create(['name' => 'sales-manager']);

    //     $permissions = Permission::pluck('id', 'id')->all();

    //     $role->syncPermissions($permissions);

    //     // $user->assignRole([$role]);
    //     $user->assignRole('sales-manager');

    // }
}
