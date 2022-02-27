<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use App\DDD\VOs\GenericVOs\GenericStringVO;

final class StringVOMother
{
    /**
     * @param string $value
     * @return GenericStringVO
     */
    public static function create(string $value): GenericStringVO
    {
        return GenericStringVO::fromValue($value);
    }

    /**
     * @return GenericStringVO
     */
    public static function random(): GenericStringVO
    {
        $faker = Factory::create();
        return GenericStringVO::fromValue($faker->word());
    }
}
