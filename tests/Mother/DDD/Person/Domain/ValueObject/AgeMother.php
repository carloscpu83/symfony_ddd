<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Person\Domain\ValueObject;

use Faker\Factory;
use App\DDD\Person\Domain\ValueObject\Age;

class AgeMother
{
    /**
     * @param integer $age
     * @return Age
     */
    public static function create(int $age): Age
    {
        return Age::fromInt($age);
    }

    /**
     * @return Age
     */
    public static function random(): Age
    {
        $faker = Factory::create();

        return self::create($faker->numberBetween(1, 100));
    }
}
