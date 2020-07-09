<?php

namespace WGT\Repositories;

use WGT\Models\Property;
use WGT\Repositories\AbstractRepository;

class PropertyRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Property::class;
    }

}
