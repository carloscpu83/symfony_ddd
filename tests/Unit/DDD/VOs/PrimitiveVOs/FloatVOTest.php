<?php

declare(strict_types=1);

namespace App\tests\Unit\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\GenericVOs\GenericFloatVO;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\FloatVOMother;

class FloatVOTest extends TestCase
{
    public function testIsFloatValue(): void
    {
        $faker = Factory::create();

        $genericFloat = GenericFloatVO::fromPrimitiveValue($faker->randomFloat(2));

        $this->assertIsFloat($genericFloat->primitiveValue());
    }

    public function testLargeDecimals(): void
    {
        $faker = Factory::create();

        $longValue = $faker->randomFloat(3);
        $shotValue = (float)bcdiv((string)$longValue, '1', 2);
        $genericFloat = GenericFloatVO::fromPrimitiveValue($longValue);

        $this->assertEquals($genericFloat->primitiveValue(), $shotValue);
    }

    public function testShortDecimals(): void
    {
        $faker = Factory::create();

        $shortValue = $faker->randomFloat(1);
        $longValue = (float)bcdiv((string)$shortValue, '1', 2);
        $genericFloat = GenericFloatVO::fromPrimitiveValue($shortValue);

        $this->assertEquals($genericFloat->primitiveValue(), (float)$longValue);
    }

    public function testWithoutDecimals(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(0);
        $genericFloat = GenericFloatVO::fromPrimitiveValue($value);

        $this->assertEquals(
            $genericFloat->primitiveValue(),
            (float)bcdiv((string)$value, '1', 2)
        );
    }

    public function testWithoutDecimalsToString()
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(0);
        $genericFloat = GenericFloatVO::fromPrimitiveValue($value);

        $this->assertEquals(
            $genericFloat->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    public function testShortDecimalsToString(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(1);
        $genericFloat = GenericFloatVO::fromPrimitiveValue($value);

        $this->assertEquals(
            $genericFloat->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    public function testLargeDecimalsToString(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(5);
        $genericFloat = GenericFloatVO::fromPrimitiveValue($value);

        $this->assertEquals(
            $genericFloat->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(5);
        $voA = GenericFloatVO::fromPrimitiveValue($value);
        $voB = GenericFloatVO::fromPrimitiveValue($value);

        $this->assertTrue($voA->equal($voB->primitiveValue()));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(3);
        $valueB = $valueA + 1;
        $voA = GenericFloatVO::fromPrimitiveValue($valueA);
        $voB = GenericFloatVO::fromPrimitiveValue($valueB);

        $this->assertFalse($voA->equal($voB->primitiveValue()));
    }

    public function testAdd(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(2);
        $valueB = $valueA + 1;
        $voA = GenericFloatVO::fromPrimitiveValue($valueA);
        $voB = GenericFloatVO::fromPrimitiveValue($valueB);
        $resultVo = $voA->addPrimitive($voB->primitiveValue());

        $this->assertEquals(
            (float)bcdiv((string)($valueA + $valueB), '1', 2),
            $resultVo->primitiveValue()
        );
    }

    public function testCheckReplaceability(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(2);
        $valueB = $valueA + 1;
        $voA = GenericFloatVO::fromPrimitiveValue($valueA);
        $voB = GenericFloatVO::fromPrimitiveValue($valueB);
        $voA->addPrimitive($voB->primitiveValue());

        $this->assertEquals(
            $valueA,
            $voA->primitiveValue()
        );
    }
}
