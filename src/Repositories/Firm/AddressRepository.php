<?php

namespace WGT\Repositories\Firm;

use WGT\Models\Firm\Address;
use WGT\Repositories\AbstractRepository;

class AddressRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Address::class;
    }
}
