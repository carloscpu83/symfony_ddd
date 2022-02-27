<?php

declare(strict_types=1);

namespace App\tests\Unit\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\GenericVOs\GenericFloatVO;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\FloatVOMother;

class FloatVOTest extends TestCase
{
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            GenericFloatVO::class,
            FloatVOMother::random()
        );
    }

    public function testIsFloatValue(): void
    {
        $float = FloatVOMother::random();

        $this->assertIsFloat($float->value());
    }

    public function testLargeDecimals(): void
    {
        $faker = Factory::create();

        $longValue = $faker->randomFloat(3);
        $shotValue = (float)bcdiv((string)$longValue, '1', 2);
        $float = FloatVOMother::create($longValue);

        $this->assertEquals($float->value(), $shotValue);
    }

    public function testShortDecimals(): void
    {
        $faker = Factory::create();

        $shortValue = $faker->randomFloat(1);
        $longValue = (float)bcdiv((string)$shortValue, '1', 2);
        $float = FloatVOMother::create($shortValue);

        $this->assertEquals($float->value(), (float)$longValue);
    }

    public function testWithoutDecimals(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(0);
        $float = FloatVOMother::create($value);

        $this->assertEquals(
            $float->value(),
            (float)bcdiv((string)$value, '1', 2)
        );
    }

    public function testWithoutDecimalsToString()
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(0);
        $float = FloatVOMother::create($value);

        $this->assertEquals(
            $float->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    public function testShortDecimalsToString(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(1);
        $float = FloatVOMother::create($value);

        $this->assertEquals(
            $float->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    public function testLargeDecimalsToString(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(5);
        $float = FloatVOMother::create($value);

        $this->assertEquals(
            $float->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(5);
        $voA = FloatVOMother::create($value);
        $voB = FloatVOMother::create($value);

        $this->assertTrue($voA->equal($voB));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(3);
        $valueB = $valueA + 1;
        $voA = FloatVOMother::create($valueA);
        $voB = FloatVOMother::create($valueB);

        $this->assertFalse($voA->equal($voB));
    }

    public function testAdd(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(2);
        $valueB = $valueA + 1;
        $voA = FloatVOMother::create($valueA);
        $voB = FloatVOMother::create($valueB);
        $resultVo = $voA->add($voB);

        $this->assertEquals(
            (float)bcdiv((string)($valueA + $valueB), '1', 2),
            $resultVo->value()
        );
    }

    public function testCheckReplaceability(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(2);
        $valueB = $valueA + 1;
        $voA = FloatVOMother::create($valueA);
        $voB = FloatVOMother::create($valueB);
        $voA->add($voB);

        $this->assertEquals(
            $valueA,
            $voA->value()
        );
    }
}
