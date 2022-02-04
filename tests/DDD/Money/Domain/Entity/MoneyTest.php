<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use App\DDD\Money\Domain\Entity\Money;
use App\DDD\Money\Domain\ValueObject\AmountVO;
use App\DDD\Money\Domain\ValueObject\CurrencyVO;
use App\DDD\VOs\PrimitiveVOs\FloatVO;
use App\DDD\VOs\PrimitiveVOs\StringVO;
use PHPUnit\Framework\TestCase;
use Faker\Factory;

class MoneyTest extends TestCase
{
    public function testInstanceOf()
    {
        $faker = Factory::create();
        $money = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('USD')),
            AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $this->assertInstanceOf(Money::class, $money);
    }
}
