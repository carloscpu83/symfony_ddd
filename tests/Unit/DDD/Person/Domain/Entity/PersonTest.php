<?php

declare(strict_types=1);

namespace App\Tests\Unit\DDD\Person\Entity;

use PHPUnit\Framework\TestCase;
use App\DDD\Person\Domain\Entity\Person;
use App\DDD\Person\Domain\ValueObject\Age;
use App\DDD\Person\Domain\ValueObject\Name;
use App\Tests\Mother\DDD\Person\Domain\ValueObject\AgeMother;
use App\Tests\Mother\DDD\Person\Domain\ValueObject\NameMother;
use App\Tests\Mother\DDD\Person\Domain\ValueObject\PasswordMother;

class PersonTest extends TestCase
{
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            Person::class,
            Person::instantiate(NameMother::random(), AgeMother::random(), PasswordMother::random())
        );
    }

    public function testInstanceOfName(): void
    {
        $person = Person::instantiate(NameMother::random(), AgeMother::random(), PasswordMother::random());
        $this->assertInstanceOf(Name::class, $person->name());
    }

    public function testInstanceOfAge(): void
    {
        $person = Person::instantiate(NameMother::random(), AgeMother::random(), PasswordMother::random());
        $this->assertInstanceOf(Age::class, $person->age());
    }

    public function testEqual(): void
    {
        $name = NameMother::random();
        $age = AgeMother::random();
        $personA = Person::instantiate($name, $age, PasswordMother::random());
        $personB = Person::instantiate($name, $age, PasswordMother::random());
        $this->assertTrue($personA->equals($personB));
    }

    public function testAgeIsNotEqual(): void
    {
        $name = NameMother::random();
        $age = AgeMother::random();
        $personA = Person::instantiate($name, $age, PasswordMother::random());
        $personB = Person::instantiate($name, Age::fromInt($age->primitiveValue() + 1), PasswordMother::random());
        $this->assertFalse($personA->equals($personB));
    }

    public function testNameIsNotEqual(): void
    {
        $name = NameMother::random();
        $age = AgeMother::random();
        $personA = Person::instantiate($name, $age, PasswordMother::random());
        $personB = Person::instantiate(NameMother::random(), $age, PasswordMother::random());
        $this->assertFalse($personA->equals($personB));
    }
}
