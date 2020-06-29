<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Position;
use WGT\Services\PositionService;

class PositionQuery extends AbstractQuery
{
    /**
     * @var PositionService
     */
    protected $service;

    /**
     * @param PositionService $service
     */
    public function __construct(PositionService $service)
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
     * @return Position
     */
    public function find($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Position
    {
        return $this->service->find($args['id']);
    }
}
