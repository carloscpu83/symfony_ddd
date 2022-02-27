<?php


declare(strict_types=1);

namespace App\Tests\Mother\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use App\DDD\VOs\GenericVOs\GenericIntegerVO;

final class IntegerVOMother
{
    /**
     * @param integer $value
     * @return GenericIntegerVO
     */
    public static function create(int $value): GenericIntegerVO
    {
        return GenericIntegerVO::fromValue($value);
    }

    /**
     * @return GenericIntegerVO
     */
    public static function random(): GenericIntegerVO
    {
        $faker = Factory::create();
        return GenericIntegerVO::fromValue($faker->randomNumber());
    }
}
