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
     * @return array
     */
    public function register($root, array $user): array
    {
        event(new Registered($user = $this->service->create($user)['data'] ?? []));
        Auth::guard()->login(new User($user));

        return $user;
    }
}
