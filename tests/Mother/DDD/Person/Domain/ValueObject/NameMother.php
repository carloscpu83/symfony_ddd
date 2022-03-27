<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Person\Domain\ValueObject;

use Faker\Factory;
use App\DDD\Person\Domain\ValueObject\Name;

class NameMother
{
    /**
     * @param string $name
     * @return Name
     */
    public static function create(string $name): Name
    {
        return Name::fromString(str_pad(substr($name, 0, 10), 10, 'x'));
    }

    /**
     * @return Name
     */
    public static function random(): Name
    {
        $faker = Factory::create('es_ES');

        return self::create($faker->name());
    }
}
