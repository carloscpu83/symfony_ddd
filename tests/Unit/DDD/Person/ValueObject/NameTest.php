<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Person\ValueObject;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\Person\Domain\ValueObject\Name;

class NameTest extends TestCase
{
    public function testAssertInstanceOf(): void
    {
        $faker = Factory::create();
        $val = $faker->name();
        $this->assertInstanceOf(Name::class, Name::fromString($val));
    }

    public function testValidName(): void
    {
        $faker = Factory::create('es_ES');
        $nameValue = str_pad($faker->name(), 10, 'x');
        $name = Name::fromString($nameValue);
        $this->assertEquals($nameValue, $name->primitiveValue());
    }

    public function testInvalidName(): void
    {
        $faker = Factory::create('es_ES');
        $this->expectException(InvalidArgumentException::class);
        Name::fromString(substr($faker->name(), 0, 1));
    }

    public function testEquals(): void
    {
        $faker = Factory::create('es_ES');
        $val = $faker->name();
        $nameA = Name::fromString($val);
        $nameB = Name::fromString($val);
        $this->assertTrue($nameA->equals($nameB));
    }

    public function testisNotEquals(): void
    {
        $faker = Factory::create('es_ES');
        $nameA = Name::fromString($faker->name());
        $nameB = Name::fromString($faker->name());
        $this->assertFalse($nameA->equals($nameB));
    }
}
