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

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function assignRole($root, array $data): array
    {
        $this->service->assignRole($data['id'], $data['role_id']);

        return ['message' => trans('messages.assigned', ['entity' => 'Role'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function removeRole($root, array $data): array
    {
        $this->service->removeRole($data['id'], $data['role_id']);

        return ['message' => trans('messages.removed', ['entity' => 'Role'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function givePermission($root, array $data): array
    {
        $this->service->givePermission($data['id'], $data['permission_id']);

        return ['message' => trans('messages.given', ['entity' => 'Permission'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function revokePermission($root, array $data): array
    {
        $this->service->revokePermission($data['id'], $data['permission_id']);

        return ['message' => trans('messages.revoked', ['entity' => 'Permission'])];
    }
}
