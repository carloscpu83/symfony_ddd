<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Person\ValueObject;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\Person\Domain\ValueObject\Age;
use InvalidArgumentException;

class AgeTest extends TestCase
{
    public function testInstanceOf(): void
    {
        $faker = Factory::create();
        $this->assertInstanceOf(Age::class, Age::fromInt($faker->numberBetween(1, 100)));
    }

    public function testIsNotAdult(): void
    {
        $faker = Factory::create();
        $age = Age::fromInt($faker->numberBetween(1, 17));
        $this->assertFalse($age->isAdult());
    }

    public function testIsAdult(): void
    {
        $faker = Factory::create();
        $age = Age::fromInt($faker->numberBetween(18, 100));
        $this->assertTrue($age->isAdult());
    }

    public function testIsNotEqual(): void
    {
        $faker = Factory::create();
        $ageA = Age::fromInt($faker->numberBetween(18, 25));
        $ageB = Age::fromInt($faker->numberBetween(26, 50));
        $this->assertFalse($ageA->equals($ageB));
    }

    public function testIsEqual(): void
    {
        $faker = Factory::create();
        $ageValue = $faker->numberBetween(18, 25);
        $ageA = Age::fromInt($ageValue);
        $ageB = Age::fromInt($ageValue);
        $this->assertTrue($ageA->equals($ageB));
    }

    public function testInvalidAge():void
    {
        $this->expectException(InvalidArgumentException::class);
        Age::fromInt(0);
    }

}
