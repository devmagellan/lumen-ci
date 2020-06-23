<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (config('permission.permissions') as $scope => $permissions) {
            foreach ($permissions as $action => $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }
    }
}
