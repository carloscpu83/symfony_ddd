<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use App\DDD\VOs\GenericVOs\GenericFloatVO;

final class FloatVOMother
{
    /**
     * @param float $value
     * @return GenericFloatVO
     */
    public static function create(float $value): GenericFloatVO
    {
        return GenericFloatVO::fromValue($value);
    }

    /**
     * @return GenericFloatVO
     */
    public static function random(int $decimals = 2): GenericFloatVO
    {
        $faker = Factory::create();
        return GenericFloatVO::fromValue($faker->randomFloat($decimals));
    }
}
