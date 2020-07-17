<?php

namespace WGT\Services;

use WGT\Repositories\PropertyItemRepository;
use WGT\Services\AbstractService;
use WGT\Services\UserService;

class PropertyItemService extends AbstractService
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param PropertyItemRepository $repository
     * @return void
     */
    public function __construct(PropertyItemRepository $repository)
    {
        $this->repository = $repository;
    }


}
