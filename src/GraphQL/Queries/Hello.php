<?php

namespace WGT\GraphQL\Queries;

use WGT\Services\UserService;

class Hello
{
    public function __invoke(): string
    {
        return 'it is working!';
    }
}
