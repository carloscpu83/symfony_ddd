<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Money\Domain\ValueObject;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\Money\Domain\ValueObject\Amount;

class AmountTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $faker = Factory::create();

        $this->assertInstanceOf(
            Amount::class,
            Amount::fromFloat($faker->randomFloat())
        );
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $amountValue = $faker->randomFloat(2);
        $voA =  Amount::fromFloat($amountValue);
        $voB =  Amount::fromFloat($amountValue);

        $this->assertTrue($voA->equals($voB));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $voA = Amount::fromFloat($faker->randomFloat(2));
        $voB = Amount::fromFloat($faker->randomFloat(2));

        $this->assertFalse($voA->equals($voB));
    }

    public function testAdd(): void
    {
        $faker = Factory::create();

        $amountValue = $faker->randomFloat(2);
        $voA = Amount::fromFloat($amountValue);
        $voB = Amount::fromFloat($amountValue + 1);
        $voC = $voA->add($voB);

        $this->assertEquals(
            (float)bcdiv(
                (string)($amountValue + 1),
                '1',
                2
            ),
            $voC->primitiveValue()
        );
    }
}
