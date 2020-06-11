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

        $permissions = config('permission.permissions');

        foreach ($permissions as $scope => $permissionsByScope) {
            foreach ($permissionsByScope as $action => $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->givePermissionTo($role->getAllPermissions());
    }
}
