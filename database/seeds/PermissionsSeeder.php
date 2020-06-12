<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::firstOrCreate(['name' => 'super-admin']);

        foreach (config('permission.permissions') as $scope => $permissions) {
            foreach ($permissions as $action => $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        // $role = Role::firstOrCreate(['name' => 'super-admin']);
        // $role->givePermissionTo($role->getAllPermissions());
    }
}
