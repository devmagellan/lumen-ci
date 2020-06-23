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
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([app(static::class), $method], $arguments);
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->repository, $method], $arguments);
    }
}
