<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Money\Domain\ValueObject;

use Faker\Factory;
use App\DDD\Money\Domain\ValueObject\Currency;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\StringVOMother;

final class CurrencyMother
{
    /**
     * @param string $value
     * @return Currency
     */
    public static function create(string $value): Currency
    {
        return Currency::fromString(StringVOMother::create($value));
    }

    /**
     * @return Currency
     */
    public static function random(): Currency
    {
        $faker = Factory::create();
        return self::create($faker->randomElement(['USD', 'EUR']));
    }
}
