<?php

namespace WGT\Repositories;

use WGT\Models\PropertyItem;
use WGT\Repositories\AbstractRepository;

class PropertyItemRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return PropertyItem::class;
    }

}
