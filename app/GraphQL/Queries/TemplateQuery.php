<?php

namespace WGT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Template;
use WGT\Services\TemplateService;

class TemplateQuery extends AbstractQuery
{
    /**
     * @var TemplateService
     */
    protected $service;

    /**
     * @param TemplateService $service
     */
    public function __construct(TemplateService $service)
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
     * @return Template
     */
    public function find($root, array $args): Template
    {
        return $this->service->find($args['id']);
    }
}
