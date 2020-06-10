<?php

namespace WGT\Repositories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

abstract class AbstractRepository extends BaseRepository implements CacheableInterface
{
    use CacheableRepository;

    /**
     * @return string
     */
    abstract public function model(): string;
}
