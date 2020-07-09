<?php

namespace WGT\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
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
     * @param array $data
     * @return Template
     */
    public function create($root, array $data): Template
    {
        $request = Arr::only($data, ['name', 'description']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $data
     * @return Template
     */
    public function update($root, array $data): Template
    {
        $request = Arr::only($data, ['id', 'name', 'description']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->update($request, $request['id']);
    }

    /**
     * @param null $root
     * @param array $template
     * @return array
     */
    public function delete($root, array $args): array
    {
        $this->service->delete($args['id']);

        return ['message' => trans('messages.deleted', ['entity' => 'Template'])];
    }
}
