<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use WGT\Services\RoleService;

class RoleMutator
{
    /**
     * @var RoleService $service
     */
    private $service;

    /**
     * @param RoleService $service
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $role
     * @return Role
     */
    public function create($root, array $role): Role
    {
        $role = Arr::except($role, 'directive');

        return $this->service->create($role);
    }

    /**
     * @param null $root
     * @param array $role
     * @return Role
     */
    public function update($root, array $role): Role
    {
        return $this->service->update($role['role'], $role['id']);
    }

    /**
     * @param null $root
     * @param array $role
     * @return array
     */
    public function delete($root, array $role): array
    {
        $this->service->delete($role['id']);

        return ['message' => trans('messages.deleted', ['entity' => 'Role'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function givePermission($root, array $data): array
    {
        $this->service->givePermission($data['id'], $data['permission_id']);

        return ['message' => trans('messages.attached', ['entity' => 'Role'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function revokePermission($root, array $data): array
    {
        $this->service->revokePermission($data['id'], $data['permission_id']);

        return ['message' => trans('messages.detached', ['entity' => 'Role'])];
    }
}
