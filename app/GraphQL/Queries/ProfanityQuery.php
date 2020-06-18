<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Profanity;
use WGT\Services\ProfanityService;

class ProfanityQuery extends AbstractQuery
{
    /**
     * @var ProfanityService
     */
    protected $service;

    /**
     * @param ProfanityService $service
     */
    public function __construct(ProfanityService $service)
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
     * @return Profanity
     */
    public function find($root, array $args): Profanity
    {
        return $this->service->find($args['id']);
    }
}
