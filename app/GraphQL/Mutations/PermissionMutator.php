<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use WGT\Services\PermissionService;

class PermissionMutator
{
    /**
     * @var PermissionService $service
     */
    private $service;

    /**
     * @param PermissionService $service
     */
    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $permission
     * @return Permission
     */
    public function create($root, array $permission): Permission
    {
        $permission = Arr::except($permission, 'directive');

        return $this->service->create($permission);
    }

    /**
     * @param null $root
     * @param array $permission
     * @return Permission
     */
    public function update($root, array $permission): Permission
    {
        return $this->service->update($permission['permission'], $permission['id']);
    }

    /**
     * @param null $root
     * @param array $permission
     * @return array
     */
    public function delete($root, array $permission): array
    {
        $this->service->delete($permission['id']);

        return ['message' => trans('messages.deleted', ['entity' => 'Permission'])];
    }
}
