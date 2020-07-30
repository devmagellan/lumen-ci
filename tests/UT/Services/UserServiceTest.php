<?php

namespace Tests\WGT\UT\Services;

use Mockery;
use Tests\WGT\UT\TestCase;
use WGT\Models\Position;
use WGT\Repositories\UserRepository;
use WGT\Services\PositionService;
use WGT\Services\UserService;

/**
 * @coversDefaultClass \WGT\Services\UserService
 */
class UserServiceTest extends TestCase
{
    /**
     * @var string
     */
    protected $testedClassName = UserService::class;

    /**
     * @covers ::attachPosition
     */
    public function testAttachPosition(): void
    {
        $firmId = 111;
        $userId = 222;
        $positionId = 333;

        $positionService = Mockery::mock(PositionService::class);
        $this->accessProperty('positionService')->setValue($this->testedClass, $positionService);

        $userRepository = Mockery::mock(UserRepository::class);
        $this->accessProperty('repository')->setValue($this->testedClass, $userRepository);

        $position = factory(Position::class)->make(['id' => $positionId, 'firm_id' => $firmId]);

        $positionService->shouldReceive('find')
            ->with($positionId)
            ->once()
            ->andReturn($position);

        $userRepository->shouldReceive('attachPositions')
            ->with($userId, [$positionId])
            ->once()
            ->andReturn(true);

        self::assertTrue($this->testedClass->attachPosition($firmId, $userId, $positionId));
    }

    /**
     * @covers ::detachPosition
     */
    public function testDetachPosition(): void
    {
        $firmId = 111;
        $userId = 222;
        $positionId = 333;

        $positionService = Mockery::mock(PositionService::class);
        $this->accessProperty('positionService')->setValue($this->testedClass, $positionService);

        $userRepository = Mockery::mock(UserRepository::class);
        $this->accessProperty('repository')->setValue($this->testedClass, $userRepository);

        $position = factory(Position::class)->make(['id' => $positionId, 'firm_id' => $firmId]);

        $positionService->shouldReceive('find')
            ->with($positionId)
            ->once()
            ->andReturn($position);

        $userRepository->shouldReceive('detachPositions')
            ->with($userId, [$positionId])
            ->once()
            ->andReturn(true);

        self::assertTrue($this->testedClass->detachPosition($firmId, $userId, $positionId));
    }
}
