<?php

declare(strict_types=1);

namespace App\tests\DDD\VOs\BasicVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\PrimitiveVOs\FloatVO;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\AmountMother;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\FloatVOMother;

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
