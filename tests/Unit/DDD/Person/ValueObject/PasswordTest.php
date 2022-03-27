<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Person\ValueObject;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\Person\Domain\ValueObject\Password;

class PasswordTest extends TestCase
{
    private const MIN_LENGTH = 5;
    private const MAX_LENGTH = 20;

    public function testInstanceOf(): void
    {
        $faker = Factory::create('es_ES');
        $this->assertInstanceOf(
            Password::class,
            Password::fromString($faker->password(self::MIN_LENGTH, self::MAX_LENGTH))
        );
    }

    public function testInvalidPassword(): void
    {
        $faker = Factory::create('es_ES');
        $this->expectException(InvalidArgumentException::class);
        Password::fromString($faker->password(1, self::MIN_LENGTH - 1));
        $this->expectException(InvalidArgumentException::class);
        Password::fromString($faker->password(self::MAX_LENGTH + 1, self::MAX_LENGTH + 2));
    }
}
