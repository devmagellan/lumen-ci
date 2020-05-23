<?php

namespace WGT\Services;

use Prettus\Repository\Contracts\RepositoryInterface;

abstract class AbstractService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return $this->repository->{$method}(...$parameters);
    }
}
