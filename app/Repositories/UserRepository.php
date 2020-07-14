<?php

namespace WGT\Repositories;

use WGT\Models\User;
use WGT\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param int $userId
     * @param int $roleId
     * @return bool
     */
    public function existsPositionsByFirmId(int $userId, int $firmId): bool
    {
        return $this->where('id', $userId)
            ->whereHas('positions', function ($position) use ($firmId) {
                $position->whereFirmId($firmId);
            })
            ->exists();
    }

    /**
     * @param int $userId
     * @param int $roleId
     * @return bool
     */
    public function assignRole(int $userId, int $roleId): bool
    {
        $this->model->find($userId)->assignRole($roleId);

        return true;
    }

    /**
     * @param int $userId
     * @param int $roleId
     * @return bool
     */
    public function removeRole(int $userId, int $roleId): bool
    {
        $this->model->find($userId)->removeRole($roleId);

        return true;
    }

    /**
     * @param int $userId
     * @param int $permissionId
     * @return bool
     */
    public function givePermission(int $userId, int $permissionId): bool
    {
        $this->model->find($userId)->givePermissionTo($permissionId);

        return true;
    }

    /**
     * @param int $userId
     * @param int $permissionId
     * @return bool
     */
    public function revokePermission(int $userId, int $permissionId): bool
    {
        $this->model->find($userId)->revokePermissionTo($permissionId);

        return true;
    }

    /**
     * @param int $userId
     * @param array $positions
     * @return bool
     */
    public function attachPositions(int $userId, array $positions): bool
    {
        $this->model->find($userId)->positions()->syncWithoutDetaching($positions);

        return true;
    }

    /**
     * @param int $userId
     * @param array $positions
     * @return bool
     */
    public function detachPositions(int $userId, array $positions): bool
    {
        return $this->model->find($userId)->positions()->detach($positions);
    }
}
