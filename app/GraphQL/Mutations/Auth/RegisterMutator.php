<?php

namespace WGT\GraphQL\Mutations\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use WGT\Models\User;
use WGT\Services\UserService;

class RegisterMutator
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
    public function register($root, array $user): User
    {
        event(new Registered($user = $this->service->create($user)));
        Auth::guard()->login($user);

        return $user;
    }
}
