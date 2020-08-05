<?php

namespace Tests\WGT\UT\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Mockery;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Tests\WGT\UT\TestCase;
use WGT\GraphQL\Queries\UserQuery;
use WGT\Models\User;
use WGT\Services\UserService;

/**
 * @coversDefaultClass \WGT\GraphQL\Queries\UserQuery
 */
class UserQueryTest extends TestCase
{
    /**
     * @var string
     */
    protected $testedClassName = UserQuery::class;

    /**
     * @covers ::all
     */
    public function testAll(): void
    {
        $root = null;
        $args = [];
        $context = Mockery::mock(GraphQLContext::class);
        $resolveInfo = Mockery::mock(ResolveInfo::class);

        $userService = Mockery::mock(UserService::class);
        $this->accessProperty('service')->setValue($this->testedClass, $userService);

        $users = factory(User::class, 10)->make();

        $userService->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($users);

        self::assertEquals(
            $users,
            $this->testedClass->all($root, $args, $context, $resolveInfo)
        );
    }

}
