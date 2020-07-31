<?php

namespace Tests\WGT\UT\Repositories;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mockery;
use Tests\WGT\UT\TestCase;
use WGT\Models\User;
use WGT\Repositories\UserRepository;

/**
 * @coversDefaultClass \WGT\Repositories\UserRepository
 */
class UserRepositoryTest extends TestCase
{
    /**
     * @var string
     */
    protected $testedClassName = UserRepository::class;

    /**
     * @covers ::attachPositions
     */
    public function testAttachPositions(): void
    {
        $userId = 222;
        $positions = [333];

        $userModel = Mockery::mock(User::class);
        $this->accessProperty('model')->setValue($this->testedClass, $userModel);

        $belongsToMany = Mockery::mock(BelongsToMany::class);

        $userModel->shouldReceive('find')
            ->with($userId)
            ->once()
            ->andReturnSelf();

        $userModel->shouldReceive('positions')
            ->with()
            ->once()
            ->andReturn($belongsToMany);

        $belongsToMany->shouldReceive('syncWithoutDetaching')
            ->with($positions)
            ->once()
            ->andReturn(true);

        self::assertTrue($this->testedClass->attachPositions($userId, $positions));
    }
}
