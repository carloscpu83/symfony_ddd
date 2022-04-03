<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Person\Domain\Service;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\Person\Domain\ValueObject\Password;
use App\DDD\Person\Domain\Service\CreateMD5Password;

class CreateMD5PasswordTest extends TestCase
{
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(CreateMD5Password::class, new CreateMD5Password());
    }

    public function testReturnsPassword(): void
    {
        $faker = Factory::create('es_ES');
        $md5Password = new CreateMD5Password();
        $this->assertInstanceOf(Password::class, $md5Password->execute($faker->word()));
    }

    public function testValidPassword(): void
    {
        $faker = Factory::create('es_ES');
        $word = $faker->word();
        $password = Password::fromString(md5($word));
        $md5Password = new CreateMD5Password();

        $this->assertTrue($password->equals($md5Password->execute($word)));
    }
}
