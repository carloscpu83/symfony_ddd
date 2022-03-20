<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Money\Domain\ValueObject;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\Money\Domain\ValueObject\Currency;

class CurrencyTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $faker = Factory::create();

        $this->assertInstanceOf(
            Currency::class,
            Currency::fromString($faker->randomElement(['USD', 'EUR']))
        );
    }

    /**
     * @return void
     */
    public function testIsoCodeNotValid(): void
    {
        $faker = Factory::create();

        $this->expectException(InvalidArgumentException::class);
        Currency::fromString($faker->word());
    }

    /**
     * @return void
     */
    public function testEquals(): void
    {
        $faker = Factory::create();

        $word = $faker->randomElement(['USD', 'EUR']);
        $voA = Currency::fromString($word);
        $voB = Currency::fromString($word);

        $this->assertTrue($voA->equals($voB));
    }

     /**
     * @return void
     */
    public function testNotEquals(): void
    {
        $voA = Currency::fromString('USD');
        $voB = Currency::fromString('EUR');

        $this->assertFalse($voA->equals($voB));
    }
}
