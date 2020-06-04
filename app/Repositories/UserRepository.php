<?php

namespace WGT\Repositories;

use WGT\Models\User;
use WGT\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
