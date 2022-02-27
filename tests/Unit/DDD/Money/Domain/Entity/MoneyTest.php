<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\PrimitiveVOs\FloatVO;
use App\DDD\Money\Domain\Entity\Money;
use App\DDD\VOs\PrimitiveVOs\StringVO;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\DDD\Money\Domain\ValueObject\Currency;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\AmountMother;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\CurrencyMother;

class MoneyTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $money = Money::instantiate(
            CurrencyMother::random(),
            AmountMother::random()
        );

        $this->assertInstanceOf(Money::class, $money);
    }

    /**
     * @return void
     */
    public function testInstanceOfCurrency(): void
    {
        $money = Money::instantiate(
            CurrencyMother::random(),
            AmountMother::random()
        );

        $this->assertInstanceOf(Currency::class, $money->currency());
    }

    /**
     * @return void
     */
    public function testInstanceOfAmount(): void
    {
        $money = Money::instantiate(
            CurrencyMother::random(),
            AmountMother::random()
        );

        $this->assertInstanceOf(Amount::class, $money->amount());
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $currency = CurrencyMother::random();
        $amount = AmountMother::random();
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
   /*  public function testNotEqual(): void
    {
        $faker = Factory::create();

        $moneyA = Money::instantiate(
            Currency::fromString(StringVO::fromString('USD')),
            Amount::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $moneyB = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
        $this->assertFalse($moneyA->equal($moneyB));
    }
 */
    /**
     * @return void
     */
  /*   public function testAddEqualCurrencies(): void
    {
        $faker = Factory::create();

        $floatA = $faker->randomFloat(2);
        $floatB = $floatA + 1;
        $moneyA = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloatVo(FloatVO::fromValue($floatA))
        );
        $moneyB = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloatVo(FloatVO::fromValue($floatB))
        );
        $moneyC = $moneyA->add($moneyB);

        $this->assertEquals(
            $moneyC->amount()->value()->value(),
            (float)bcdiv((string)($floatA + $floatB), '1', 2)
        );
    } */

    /**
     * @return void
     */
/*     public function testAddNotEqualCurrencies(): void
    {
        $faker = Factory::create();

        $floatA = $faker->randomFloat(2);
        $floatB = $floatA + 1;
        $moneyA = Money::instantiate(
            Currency::fromString(StringVO::fromString('USD')),
            Amount::fromFloatVo(FloatVO::fromValue($floatA))
        );
        $moneyB = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloatVo(FloatVO::fromValue($floatB))
        );

        $this->expectException(InvalidArgumentException::class);
        $moneyA->add($moneyB);
    } */

    /**
     * @return void
     */
 /*    public function testCheckReplaceability(): void
    {
        $faker = Factory::create();

        $floatA = $faker->randomFloat(2);
        $floatB = $floatA + 1;
        $moneyA = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloatVo(FloatVO::fromValue($floatA))
        );
        $moneyB = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloatVo(FloatVO::fromValue($floatB))
        );
        $moneyA->add($moneyB);

        $this->assertEquals(
            $moneyA->amount()->value()->value(),
            $floatA
        );
    } */
}
