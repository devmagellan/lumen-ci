<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Spatie\Permission\Models\Role;
use WGT\Services\RoleService;

class RoleQuery extends AbstractQuery
{
    /**
     * @var RoleService
     */
    protected $service;

    /**
     * @param RoleService $service
     */
    public function __construct(RoleService $service)
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
     * @return Role
     */
    public function find($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Role
    {
        return $this->service->find($args['id']);
    }
}
