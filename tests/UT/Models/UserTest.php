<?php

namespace Tests\WGT\UT\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\WGT\UT\TestCase;
use WGT\Models\User;

/**
 * @coversDefaultClass \WGT\Models\User
 */
class UserTest extends TestCase
{
    /**
     * @var string
     */
    protected $testedClassName = User::class;

    /**
     * @covers ::positions
     */
    public function testPositions(): void
    {
        self::assertInstanceOf(BelongsToMany::class, $this->testedClass->positions());
    }

}
