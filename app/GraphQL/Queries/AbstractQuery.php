<?php

namespace WGT\GraphQL\Queries;

use WGT\Services\ServiceInterface;

abstract class AbstractQuery
{
    /**
     * @var ServiceInterface
     */
    protected $service;
}
