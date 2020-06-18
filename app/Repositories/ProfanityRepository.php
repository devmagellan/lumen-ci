<?php

namespace WGT\Repositories;

use WGT\Models\Profanity;
use WGT\Repositories\AbstractRepository;

class ProfanityRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Profanity::class;
    }
}
