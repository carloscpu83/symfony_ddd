<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Person\Domain\ValueObject;

use Faker\Factory;
use App\DDD\Person\Domain\ValueObject\Password;

class PasswordMother
{
    private const MIN_LENGTH = 5;
    private const MAX_LENGTH = 20;

    /**
     * @param string $password
     * @return Password
     */
    public static function create(string $password): Password
    {
        return Password::fromString($password);
    }

    /**
     * @return Password
     */
    public static function random(): Password
    {
        $faker = Factory::create();
        return self::create($faker->password(self::MIN_LENGTH, self::MAX_LENGTH));
    }
}
