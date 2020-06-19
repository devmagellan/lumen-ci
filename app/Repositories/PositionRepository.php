<?php

namespace WGT\Repositories;

use WGT\Models\Position;
use WGT\Repositories\AbstractRepository;

class PositionRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Position::class;
    }
}
