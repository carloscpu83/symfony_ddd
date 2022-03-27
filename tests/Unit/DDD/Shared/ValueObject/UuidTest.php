<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Shared\ValueObject;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\Shared\Domain\ValueObject\Uuid;

class UuidTest extends TestCase
{
    public function testUuidNotValid(): void
    {
        $faker = Factory::create();

        $this->expectException(InvalidArgumentException::class);

        Uuid::fromValue($faker->word());
    }

    public function testValidUuid(): void
    {
        $faker = Factory::create();

        $generatedUuid = $faker->uuid();
        $uuid = Uuid::fromValue($generatedUuid);

        $this->assertEquals($generatedUuid, $uuid->value());
    }

    public function testToString(): void
    {
        $faker = Factory::create();

        $generatedUuid = $faker->uuid();
        $uuid = Uuid::fromValue($generatedUuid);

        $this->assertIsString($uuid->value());
    }

    public function testEquals(): void
    {
        $faker = Factory::create();

        $generatedUuid = $faker->uuid();
        $uuid = Uuid::fromValue($generatedUuid);
        $otherUuid = Uuid::fromValue($generatedUuid);

        $this->assertTrue($uuid->equals($otherUuid));
    }
}
