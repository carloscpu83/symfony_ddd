<?php

declare(strict_types=1);

namespace App\tests\Unit\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\GenericVOs\GenericIntegerVO;

class IntegerVOTest extends TestCase
{
    public function testValueIsEqual(): void
    {
        $faker = Factory::create();

        $fakerValue = $faker->randomNumber();
        $integerVO = GenericIntegerVO::fromPrimitiveValue($fakerValue);

        $this->assertEquals($fakerValue, $integerVO->primitiveValue());
    }

    public function testValueIsStringEqual(): void
    {
        $faker = Factory::create();

        $fakerValue = $faker->randomNumber();
        $integerVO = GenericIntegerVO::fromPrimitiveValue($fakerValue);

        $this->assertEquals((string)$fakerValue, $integerVO->__toString());
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->randomNumber();
        $voA = GenericIntegerVO::fromPrimitiveValue($value);
        $voB = GenericIntegerVO::fromPrimitiveValue($value);

        $this->assertTrue($voA->equal($voB->primitiveValue()));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();
        $testNumber = $faker->randomNumber();

        $voA = GenericIntegerVO::fromPrimitiveValue($testNumber);
        $voB = GenericIntegerVO::fromPrimitiveValue($testNumber + 1);

        $this->assertFalse($voA->equal($voB->primitiveValue()));
    }
}
