<?php

namespace WGT\GraphQL\Queries;

use WGT\Services\FirmService;

class FirmQuery extends AbstractQuery
{
    /**
     * @var FirmService
     */
    protected $service;

    /**
     * @param FirmService $service
     */
    public function __construct(FirmService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->service->all()['data'] ?? [];
    }

    /**
     * @return array
     */
    public function find($root, array $args)
    {
        return $this->service->find($args['id'])['data'] ?? [];
    }
}
