<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'view_profile']);

        // Create roles        
        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);

        // Sync roles with permissions
        $role_admin->givePermissionTo(Permission::all());
        $role_user->givePermissionTo('view_profile');

        // Assign roles to demo users
        $admin = User::find(1);
        $admin->assignRole('admin');

        $user = User::find(2);
        $user->assignRole('user');

        $user = User::find(3);
        $user->assignRole('user');
    }
}
