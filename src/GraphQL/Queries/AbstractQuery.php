<?php

namespace WGT\GraphQL\Queries;

use WGT\Services\ServiceInterface;

abstract class AbstractQuery
{
    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return $this->service->{$method}(...$parameters);
    }
}
