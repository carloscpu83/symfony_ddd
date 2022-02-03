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
}
