<?php

declare(strict_types=1);

namespace App\tests\DDD\VOs\PrimitiveVOs;

use App\DDD\VOs\PrimitiveVOs\FloatVO;
use PHPUnit\Framework\TestCase;
use Faker\Factory;

class FloatVOTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $faker = Factory::create();

        $this->assertInstanceOf(
            FloatVO::class,
            FloatVO::fromValue($faker->randomFloat(3))
        );
    }

    /**
     * @return void
     */
    public function testIsFloatValue(): void
    {
        $faker = Factory::create();

        $float = FloatVO::fromValue($faker->randomFloat(3));

        $this->assertIsFloat($float->value());
    }

    /**
     * @return void
     */
    public function testLargeDecimals(): void
    {
        $faker = Factory::create();

        $longValue = $faker->randomFloat(3);
        $shotValue = (float)bcdiv((string)$longValue, '1', 2);
        $float = FloatVO::fromValue($longValue);

        $this->assertEquals($float->value(), $shotValue);
    }

    /**
     * @return void
     */
    public function testShortDecimals(): void
    {
        $faker = Factory::create();

        $shortValue = $faker->randomFloat(1);
        $longValue = (float)bcdiv((string)$shortValue, '1', 2);
        $float = FloatVO::fromValue($shortValue);

        $this->assertEquals($float->value(), (float)$longValue);
    }

    /**
     * @return void
     */
    public function testWithoutDecimals(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(0);
        $float = FloatVO::fromValue($value);

        $this->assertEquals(
            $float->value(),
            (float)bcdiv((string)$value, '1', 2)
        );
    }

    /**
     * @return void
     */
    public function testWithoutDecimalsToString()
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(0);
        $float = FloatVO::fromValue($value);

        $this->assertEquals(
            $float->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    /**
     * @return void
     */
    public function testShortDecimalsToString(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(1);
        $float = FloatVO::fromValue($value);

        $this->assertEquals(
            $float->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    /**
     * @return void
     */
    public function testLargeDecimalsToString(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(5);
        $float = FloatVO::fromValue($value);

        $this->assertEquals(
            $float->__toString(),
            number_format((float)bcdiv((string)$value, '1', 2), 2, ',', '')
        );
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->randomFloat(5);
        $voA = FloatVO::fromValue($value);
        $voB = FloatVO::fromValue($value);

        $this->assertTrue($voA->equal($voB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(3);
        $valueB = $faker->randomFloat(4);
        $voA = FloatVO::fromValue($valueA);
        $voB = FloatVO::fromValue($valueB);

        $this->assertFalse($voA->equal($voB));
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $faker = Factory::create();

        $valueA = $faker->randomFloat(2);
        $valueB = $faker->randomFloat(2);
        $voA = FloatVO::fromValue($valueA);
        $voB = FloatVO::fromValue($valueB);
        $resultVo = $voA->add($voB);

        $this->assertEquals(
            (float)bcdiv((string)($valueA + $valueB), '1', 2),
            $resultVo->value()
        );
    }
}
