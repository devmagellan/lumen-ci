<?php

namespace WGT\Services;

use Prettus\Repository\Contracts\RepositoryInterface;
use WGT\Services\ServiceInterface;

abstract class AbstractService implements ServiceInterface
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
