<?php

namespace WGT\Repositories;

use Spatie\Permission\Models\Role;
use WGT\Repositories\AbstractRepository;

class RoleRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * @param int $roleId
     * @param int $permissionId
     * @return bool
     */
    public function givePermission(int $roleId, int $permissionId): bool
    {
        $this->model->find($roleId)->givePermissionTo($permissionId);

        return true;
    }

    /**
     * @param int $roleId
     * @param int $permissionId
     * @return bool
     */
    public function revokePermission(int $roleId, int $permissionId): bool
    {
        $this->model->find($roleId)->revokePermissionTo($permissionId);

        return true;
    }
}
