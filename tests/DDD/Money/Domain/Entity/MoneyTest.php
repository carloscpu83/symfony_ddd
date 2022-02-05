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
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $faker = Factory::create();
        $money = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('USD')),
            AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $this->assertInstanceOf(Money::class, $money);
    }

    /**
     * @return void
     */
    public function testInstanceOfCurrency(): void
    {
        $faker = Factory::create();
        $currency = CurrencyVO::fromStringVo(StringVO::fromString('USD'));
        $money = Money::instantiate(
            $currency,
            AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $this->assertInstanceOf(CurrencyVO::class, $money->currency());
    }

    /**
     * @return void
     */
    public function testInstanceOfAmount(): void
    {
        $faker = Factory::create();
        $amount = AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)));
        $money = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('USD')),
            $amount
        );
        $this->assertInstanceOf(AmountVO::class, $money->amount());
    }
}
