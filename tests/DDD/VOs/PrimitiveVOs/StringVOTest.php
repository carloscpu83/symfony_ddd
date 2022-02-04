<?php

declare(strict_types=1);

namespace App\tests\DDD\VOs\PrimitiveVOs;

use PHPUnit\Framework\TestCase;
use App\DDD\VOs\PrimitiveVOs\StringVO;
use Faker\Factory;

class StringVOTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $faker = Factory::create();
        $this->assertInstanceOf(StringVO::class, StringVO::fromString($faker->word()));
    }

    /**
     * @return void
     */
    public function testToString(): void
    {
        $faker = Factory::create();
        $string = StringVO::fromString($faker->word());
        $this->assertIsString($string->__toString());
    }

    /**
     * @return void
     */
    public function testValueIsEqual(): void
    {
        $faker = Factory::create();
        $word = $faker->word();
        $string = StringVO::fromString($word);

        $this->assertEquals($word, $string->value());
    }

    /**
     * @return void
     */
    public function testStringIsLower(): void
    {
        $faker = Factory::create();
        $word = strtolower($faker->word());
        $string = StringVO::fromString($word);

        $this->assertEquals($word, $string->toLower());
    }

    /**
     * @return void
     */
    public function testStringIsNotLower(): void
    {
        $faker = Factory::create();
        $word = strtoupper($faker->word());
        $string = StringVO::fromString($word);

        $this->assertNotEquals($word, $string->toLower());
    }

    /**
     * @return void
     */
    public function testStringIsUpper(): void
    {
        $faker = Factory::create();
        $word = strtoupper($faker->word());
        $string = StringVO::fromString($word);

        $this->assertEquals($word, $string->toUpper());
    }

    /**
     * @return void
     */
    public function testStringIsNotUpper(): void
    {
        $faker = Factory::create();
        $word = strtolower($faker->word());
        $string = StringVO::fromString($word);

        $this->assertNotEquals($word, $string->toUpper());
    }

    /**
     * @return void
     */
    public function testCapitalizeString(): void
    {
        $faker = Factory::create();
        $word = ucfirst(strtolower($faker->word()));
        $string = StringVO::fromString($word);

        $this->assertEquals($word, $string->capitalize());
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $faker = Factory::create();
        $value = $faker->word();
        $voA = StringVO::fromString($value);
        $voB = StringVO::fromString($value);
        $this->assertTrue($voA->equal($voB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $faker = Factory::create();
        $valueA = $faker->word();
        $valueB = $faker->word();
        $voA = StringVO::fromString($valueA);
        $voB = StringVO::fromString($valueB);
        $this->assertFalse($voA->equal($voB));
    }
}
