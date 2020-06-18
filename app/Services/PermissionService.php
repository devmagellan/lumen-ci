<?php

namespace WGT\Services;

use WGT\Repositories\PermissionRepository;
use WGT\Services\AbstractService;

class PermissionService extends AbstractService
{
    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }
}
