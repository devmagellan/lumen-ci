<?php

namespace WGT\Services;

use WGT\Repositories\UserRepository;
use WGT\Services\AbstractService;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
