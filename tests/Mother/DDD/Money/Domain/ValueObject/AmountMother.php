<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Money\Domain\ValueObject;

use Faker\Factory;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\FloatVOMother;

final class AmountMother
{
    /**
     * @param float $value
     * @return Amount
     */
    public static function create(float $value): Amount
    {
        return Amount::fromFloat(FloatVOMother::create($value));
    }

    /**
     * @param integer $length
     * @return Amount
     */
    public static function random(int $length = 2): Amount
    {
        $faker = Factory::create();
        return self::create($faker->randomFloat($length));
    }
}
