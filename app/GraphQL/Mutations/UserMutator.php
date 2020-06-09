<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use WGT\Models\User;
use WGT\Services\UserService;

class UserMutator
{
    /**
     * @var UserService $service
     */
    private $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $user
     * @return User
     */
    public function update($root, array $user): User
    {
        return $this->service->update($user, Auth::user()->id);
    }
}
