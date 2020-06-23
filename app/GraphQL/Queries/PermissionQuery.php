<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Spatie\Permission\Models\Permission;
use WGT\Services\PermissionService;

class PermissionQuery extends AbstractQuery
{
    /**
     * @var PermissionService
     */
    protected $service;

    /**
     * @param PermissionService $service
     */
    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return Collection
     */
    public function all($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Collection
    {
        return $this->service->all();
    }

    /**
     * @param null $root
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return Permission
     */
    public function find($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Permission
    {
        return $this->service->find($args['id']);
    }
}
