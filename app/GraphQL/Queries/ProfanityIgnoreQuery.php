<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Profanity\ProfanityIgnore;
use WGT\Services\ProfanityIgnoreService;

class ProfanityIgnoreQuery extends AbstractQuery
{
    /**
     * @var ProfanityIgnoreService
     */
    protected $service;

    /**
     * @param ProfanityIgnoreService $service
     */
    public function __construct(ProfanityIgnoreService $service)
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
     * @return ProfanityIgnore
     */
    public function find($root, array $args): ProfanityIgnore
    {
        return $this->service->find($args['id']);
    }
}
