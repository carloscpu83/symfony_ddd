<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Shared\Domain\ValueObject;

use Faker\Factory;
use App\DDD\Shared\Domain\ValueObject\Uuid;

class UuidMother
{
    /**
     * @param string $value
     * @return Uuid
     */
    public static function create(string $value): Uuid
    {
        return Uuid::fromValue($value);
    }

    /**
     * @return Uuid
     */
    public static function random(): Uuid
    {
        $faker = Factory::create();
        return self::create($faker->uuid());
    }
}
