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
    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $moneyA = Money::instantiate(
            CurrencyMother::random(),
            AmountMother::random()
        );
        $moneyB = Money::instantiate(
            CurrencyMother::random(),
            AmountMother::random()
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
        $currency = CurrencyMother::random();
        $moneyA = Money::instantiate(
            $currency,
            AmountMother::create($floatA)
        );
        $moneyB = Money::instantiate(
            $currency,
            AmountMother::create($floatB)
        );
        $moneyC = $moneyA->add($moneyB);

        $this->assertEquals(
            $moneyC->amount()->primitiveValue(),
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
            Currency::fromString('USD'),
            Amount::fromFloat($floatA)
        );
        $moneyB = Money::instantiate(
            Currency::fromString('EUR'),
            Amount::fromFloat($floatB)
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
        $currencyValue = 'EUR';

        $moneyA = Money::instantiate(
            Currency::fromString($currencyValue),
            Amount::fromFloat($floatA)
        );
        $moneyB = Money::instantiate(
            Currency::fromString($currencyValue),
            Amount::fromFloat($floatB)
        );
        $moneyA->add($moneyB);

        $this->assertEquals(
            $moneyA->amount()->value()->value(),
            $floatA
        );
    }
}
