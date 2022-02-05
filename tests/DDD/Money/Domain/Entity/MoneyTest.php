<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\PrimitiveVOs\FloatVO;
use App\DDD\Money\Domain\Entity\Money;
use App\DDD\VOs\PrimitiveVOs\StringVO;
use App\DDD\Money\Domain\ValueObject\AmountVO;
use App\DDD\Money\Domain\ValueObject\CurrencyVO;

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

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $faker = Factory::create();

        $currency = CurrencyVO::fromStringVo(StringVO::fromString('USD'));
        $amount = AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)));
        $moneyA = Money::instantiate(
            $currency,
            $amount
        );
        $moneyB = Money::instantiate(
            $currency,
            $amount
        );

        $this->assertTrue($moneyA->equal($moneyB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $moneyA = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('USD')),
            AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $moneyB = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $this->assertFalse($moneyA->equal($moneyB));
    }

    /**
     * @return void
     */
    public function testAddEqualCurrencies(): void
    {
        $faker = Factory::create();

        $floatA = $faker->randomFloat(2);
        $floatB = $floatA + 1;
        $moneyA = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue($floatA))
        );
        $moneyB = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue($floatB))
        );
        $moneyC = $moneyA->add($moneyB);

        $this->assertEquals(
            $moneyC->amount()->value()->value(),
            (float)bcdiv((string)($floatA + $floatB), '1', 2)
        );
    }

    /**
     * @return void
     */
    public function testAddNotEqualCurrencies(): void
    {
        $faker = Factory::create();

        $floatA = $faker->randomFloat(2);
        $floatB = $floatA + 1;
        $moneyA = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('USD')),
            AmountVO::fromFloatVo(FloatVO::fromValue($floatA))
        );
        $moneyB = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue($floatB))
        );

        $this->expectException(InvalidArgumentException::class);
        $moneyA->add($moneyB);
    }

    /**
     * @return void
     */
    public function testCheckReplaceability(): void
    {
        $faker = Factory::create();

        $floatA = $faker->randomFloat(2);
        $floatB = $floatA + 1;
        $moneyA = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue($floatA))
        );
        $moneyB = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue($floatB))
        );
        $moneyA->add($moneyB);

        $this->assertEquals(
            $moneyA->amount()->value()->value(),
            $floatA
        );
    }
}
