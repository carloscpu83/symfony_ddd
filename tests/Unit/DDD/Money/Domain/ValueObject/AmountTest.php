<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Money\Domain\ValueObject;

use Faker\Factory;
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

    public function testEqual(): void
    {
        $faker = Factory::create();

        $amountValue = $faker->randomFloat(2);
        $voA = AmountMother::create($amountValue);
        $voB = AmountMother::create($amountValue);

        $this->assertTrue($voA->equals($voB));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $voA = AmountMother::create($faker->randomFloat(2));
        $voB = AmountMother::create($faker->randomFloat(2));

        $this->assertFalse($voA->equals($voB));
    }

    public function testAdd(): void
    {
        $faker = Factory::create();

        $amountValue = $faker->randomFloat(2);
        $voA = AmountMother::create($amountValue);
        $voB = AmountMother::create($amountValue + 1);
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
