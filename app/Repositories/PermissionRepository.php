<?php

namespace WGT\Repositories;

use Spatie\Permission\Models\Permission;
use WGT\Repositories\AbstractRepository;

class PermissionRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Permission::class;
    }
}
