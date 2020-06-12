<?php

namespace WGT\Services;

use WGT\Repositories\RoleRepository;
use WGT\Services\AbstractService;

class RoleService extends AbstractService
{
    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }
}
