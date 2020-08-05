<?php

namespace Tests\WGT\UT\GraphQL\Mutations;

use Mockery;
use Tests\WGT\UT\TestCase;
use WGT\GraphQL\Mutations\UserMutator;
use WGT\Services\UserService;

/**
 * @coversDefaultClass \WGT\GraphQL\Mutations\UserMutator
 */
class UserMutatorTest extends TestCase
{
    /**
     * @var string
     */
    protected $testedClassName = UserMutator::class;

    /**
     * @covers ::assignRole
     */
    public function testAssignRole(): void
    {
        $root = null;
        $data = ['id' => 111, 'role_id' => 222];

        $userService = Mockery::mock(UserService::class);
        $this->accessProperty('service')->setValue($this->testedClass, $userService);

        $userService->shouldReceive('assignRole')
            ->with($data['id'], $data['role_id'])
            ->once();

        self::assertEquals(
            ['message' => __('messages.assigned', ['entity' => 'Role'])],
            $this->testedClass->assignRole($root, $data)
        );
    }

}
