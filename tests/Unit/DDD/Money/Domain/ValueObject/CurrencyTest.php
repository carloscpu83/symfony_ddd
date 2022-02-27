<?php

declare(strict_types=1);

namespace App\tests\DDD\VOs\BasicVOs;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\PrimitiveVOs\StringVO;
use App\DDD\Money\Domain\ValueObject\Currency;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\StringVOMother;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\CurrencyMother;

class CurrencyTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            Currency::class,
            CurrencyMother::random()
        );
    }

    /**
     * @return void
     */
    public function testIsoCodeNotValid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        CurrencyMother::create(StringVOMother::random()->value());
    }
}
