<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Money\Domain\ValueObject;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\Money\Domain\ValueObject\Currency;
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
        $faker = Factory::create();

        $this->expectException(InvalidArgumentException::class);
        CurrencyMother::create($faker->word());
    }

    /**
     * @return void
     */
    public function testEquals(): void
    {
        $faker = Factory::create();

        $word = $faker->randomElement(['USD', 'EUR']);
        $voA = CurrencyMother::create($word);
        $voB = CurrencyMother::create($word);

        $this->assertTrue($voA->equals($voB));
    }

     /**
     * @return void
     */
    public function testNotEquals(): void
    {
        $voA = CurrencyMother::create('USD');
        $voB = CurrencyMother::create('EUR');

        $this->assertFalse($voA->equals($voB));
    }
}
