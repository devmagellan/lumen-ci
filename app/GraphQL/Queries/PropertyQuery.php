<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Property;
use WGT\Services\PropertyService;

class PropertyQuery extends AbstractQuery
{
    /**
     * @var PropertyService
     */
    protected $service;

    /**
     * @param PropertyService $service
     */
    public function __construct(PropertyService $service)
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
     * @return Property
     */
    public function find($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Property
    {
        return $this->service->find($args['id']);
    }
}
