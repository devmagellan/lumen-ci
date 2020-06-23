<?php

namespace WGT\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Template;
use WGT\Services\TemplateService;

class TemplateMutator
{
    /**
     * @var TemplateService $service
     */
    private $service;

    /**
     * @param TemplateService $service
     */
    public function __construct(TemplateService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $template
     * @return Template
     */
    public function create($root, array $template): Template
    {
        $template['user_id'] = auth()->user()->id;
        return $this->service->create($template);
    }

    /**
     * @param null $root
     * @param array $template
     * @return Template
     */
    public function update($root, array $template): Template
    {
        $template['user_id'] = auth()->user()->id;
        return $this->service->update($template, $template['id']);
    }

    /**
     * @param null $root
     * @param array $template
     * @return array
     */
    public function delete($root, array $template): array
    {
        $this->service->delete($template['id']);

        return ['message' => trans('messages.deleted', ['entity' => 'Template'])];
    }
}
