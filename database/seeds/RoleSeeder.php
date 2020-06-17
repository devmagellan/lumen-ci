<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use WGT\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $ownerAdminRole = Role::firstOrCreate(['name' => 'owner-admin']);

        $ownerAdminRole->syncPermissions(
            Arr::except(config('permission.permissions'), ['roles', 'permissions'])
        );

        $adminUser = User::where('email', 'admin@worldgemtrade.com')->first();
        if (!empty($adminUser)) {
            $adminUser->assignRole($superAdminRole->id);
        }

        $devUser = User::where('email', 'dev@worldgemtrade.com')->first();
        if (!empty($devUser)) {
            $devUser->assignRole($ownerAdminRole->id);
        }
    }
}
