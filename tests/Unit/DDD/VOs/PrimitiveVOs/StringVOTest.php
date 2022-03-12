<?php

declare(strict_types=1);

namespace App\tests\Unit\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\GenericVOs\GenericStringVO;

class StringVOTest extends TestCase
{
    public function testValueIsEqual(): void
    {
        $faker = Factory::create();

        $word = $faker->word();
        $genericString = GenericStringVO::fromPrimitiveValue($word);

        $this->assertEquals($word, $genericString->primitiveValue());
    }

    public function testStringIsLower(): void
    {
        $faker = Factory::create();

        $word = strtolower($faker->word());
        $genericString = GenericStringVO::fromPrimitiveValue($word);

        $this->assertEquals($word, $genericString->toLower());
    }

    public function testStringIsNotLower(): void
    {
        $faker = Factory::create();

        $word = strtoupper($faker->word());
        $genericString = GenericStringVO::fromPrimitiveValue($word);

        $this->assertNotEquals($word, $genericString->toLower());
    }

    public function testStringIsUpper(): void
    {
        $faker = Factory::create();

        $word = strtoupper($faker->word());
        $genericString = GenericStringVO::fromPrimitiveValue($word);

        $this->assertEquals($word, $genericString->toUpper());
    }

    public function testStringIsNotUpper(): void
    {
        $faker = Factory::create();

        $word = strtolower($faker->word());
        $genericString = GenericStringVO::fromPrimitiveValue($word);

        $this->assertNotEquals($word, $genericString->toUpper());
    }

    public function testCapitalizeString(): void
    {
        $faker = Factory::create();

        $word = ucfirst(strtolower($faker->word()));
        $genericString = GenericStringVO::fromPrimitiveValue($word);

        $this->assertEquals($word, $genericString->capitalize());
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->word();
        $voA = GenericStringVO::fromPrimitiveValue($value);
        $voB = GenericStringVO::fromPrimitiveValue($value);

        $this->assertTrue($voA->equal($voB->primitiveValue()));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $voA = GenericStringVO::fromPrimitiveValue($faker->word());
        $voB = GenericStringVO::fromPrimitiveValue($faker->word());

        $this->assertFalse($voA->equal($voB->primitiveValue()));
    }
}
