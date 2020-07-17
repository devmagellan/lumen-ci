<?php

namespace WGT\Services;

use WGT\Repositories\PropertyRepository;
use WGT\Services\AbstractService;
use WGT\Services\UserService;

class PropertyService extends AbstractService
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param PropertyRepository $repository
     * @return void
     */
    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }


}
