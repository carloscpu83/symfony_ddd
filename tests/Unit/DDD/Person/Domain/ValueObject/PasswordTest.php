<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Person\ValueObject;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\Person\Domain\ValueObject\Password;

class PasswordTest extends TestCase
{
    private const LENGTH = 32;

    public function testInstanceOf(): void
    {
        $faker = Factory::create('es_ES');
        $this->assertInstanceOf(
            Password::class,
            Password::fromString($faker->password(self::LENGTH, self::LENGTH))
        );
    }

    public function testInvalidPassword(): void
    {
        $faker = Factory::create('es_ES');
        $this->expectException(InvalidArgumentException::class);
        Password::fromString($faker->password(self::LENGTH - 1, self::LENGTH - 1));
        $this->expectException(InvalidArgumentException::class);
        Password::fromString($faker->password(self::LENGTH + 1, self::LENGTH + 1));
    }

    public function testEquals(): void
    {
        $faker = Factory::create('es_ES');
        $word = $faker->word();
        $passwordA = Password::fromString(md5($word));
        $passwordB = Password::fromString(md5($word));
        $this->assertTrue($passwordA->equals($passwordB));
    }

    public function testIsNotEquals(): void
    {
        $faker = Factory::create('es_ES');
        $word = $faker->word();
        $passwordA = Password::fromString(md5($word));
        $passwordB = Password::fromString(md5($word . 'a'));
        $this->assertFalse($passwordA->equals($passwordB));
    }
}
