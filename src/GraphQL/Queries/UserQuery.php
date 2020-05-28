<?php

namespace WGT\GraphQL\Queries;

use WGT\Services\UserService;

class UserQuery extends AbstractQuery
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->service->all()['data'] ?? [];
    }

    /**
     * @return array
     */
    public function find($root, array $args)
    {
        return $this->service->find($args['id'])['data'] ?? [];
    }
}
