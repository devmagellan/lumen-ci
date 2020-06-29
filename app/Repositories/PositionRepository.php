<?php

namespace WGT\Repositories;

use WGT\Models\Position;
use WGT\Repositories\AbstractRepository;

class PositionRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Position::class;
    }

    /**
     * @param int $positionId
     * @param int $permissionId
     * @return bool
     */
    public function givePermission(int $positionId, int $permissionId): bool
    {
        $this->model->find($positionId)->givePermissionTo($permissionId);

        return true;
    }

    /**
     * @param int $positionId
     * @param int $permissionId
     * @return bool
     */
    public function revokePermission(int $positionId, int $permissionId): bool
    {
        $this->model->find($positionId)->revokePermissionTo($permissionId);

        return true;
    }
}
