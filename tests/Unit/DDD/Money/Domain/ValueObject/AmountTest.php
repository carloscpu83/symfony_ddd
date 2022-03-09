<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Money\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\AmountMother;

class AmountTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            Amount::class,
            AmountMother::random()
        );
    }
}
