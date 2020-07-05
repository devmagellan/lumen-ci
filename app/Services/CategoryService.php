<?php

namespace WGT\Services;

use WGT\Repositories\CategoryRepository;
use WGT\Services\AbstractService;
use WGT\Services\UserService;

class CategoryService extends AbstractService
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param CategoryRepository $repository
     * @param UserService $userService
     * @return void
     */
    public function __construct(CategoryRepository $repository, UserService $userService)
    {
        $this->repository = $repository;
        $this->userService = $userService;
    }

}
