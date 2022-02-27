<?php

declare(strict_types=1);

namespace App\tests\Unit\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\GenericVOs\GenericIntegerVO;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\IntegerVOMother;

class IntegerVOTest extends TestCase
{
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(GenericIntegerVO::class, IntegerVOMother::random());
    }

    public function testValueIsEqual(): void
    {
        $faker = Factory::create();

        $fakerValue = $faker->randomNumber();
        $integerVO = IntegerVOMother::create($fakerValue);

        $this->assertEquals($fakerValue, $integerVO->value());
    }

    public function testValueIsStringEqual(): void
    {
        $faker = Factory::create();

        $fakerValue = $faker->randomNumber();
        $integerVO = IntegerVOMother::create($fakerValue);

        $this->assertEquals((string)$fakerValue, $integerVO->__toString());
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->randomNumber();
        $voA = IntegerVOMother::create($value);
        $voB = IntegerVOMother::create($value);

        $this->assertTrue($voA->equal($voB));
    }

    public function testNotEqual(): void
    {
        $voA = IntegerVOMother::random();
        $voB = IntegerVOMother::random();

        $this->assertFalse($voA->equal($voB));
    }
}
