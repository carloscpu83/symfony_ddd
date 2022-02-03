<?php

declare(strict_types=1);

namespace App\tests;

use PHPUnit\Framework\TestCase;
use App\DDD\VOs\PrimitiveVOs\IntegerVO;
use Faker\Factory;

class IntegerVOTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(IntegerVO::class, IntegerVO::fromInt(15));
    }

    /**
     * @return void
     */
    public function testValueIsEqual(): void
    {
        $faker = Factory::create();
        $fakerValue = $faker->randomNumber();
        $integerVO = IntegerVO::fromInt($fakerValue);
        $this->assertEquals($fakerValue, $integerVO->value());
    }

    /**
     * @return void
     */
    public function testValueIsStringEqual(): void
    {
        $faker = Factory::create();
        $fakerValue = $faker->randomNumber();
        $integerVO = IntegerVO::fromInt($fakerValue);
        $this->assertEquals((string)$fakerValue, $integerVO->__toString());
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $faker = Factory::create();
        $value = $faker->randomNumber();
        $voA = IntegerVO::fromInt($value);
        $voB = IntegerVO::fromInt($value);
        $this->assertTrue($voA->equal($voB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $faker = Factory::create();
        $valueA = $faker->randomNumber();
        $valueB = $faker->randomNumber();
        $voA = IntegerVO::fromInt($valueA);
        $voB = IntegerVO::fromInt($valueB);
        $this->assertFalse($voA->equal($voB));
    }
}
