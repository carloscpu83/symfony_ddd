<?php

declare(strict_types=1);

namespace App\tests\Unit\DDD\VOs\PrimitiveVOs;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\GenericVOs\GenericStringVO;
use App\Tests\Mother\DDD\VOs\PrimitiveVOs\StringVOMother;

class StringVOTest extends TestCase
{
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(GenericStringVO::class, StringVOMother::random());
    }

    public function testValueIsEqual(): void
    {
        $faker = Factory::create();

        $word = $faker->word();
        $string = StringVOMother::create($word);

        $this->assertEquals($word, $string->value());
    }

    public function testStringIsLower(): void
    {
        $faker = Factory::create();

        $word = strtolower($faker->word());
        $string = StringVOMother::create($word);

        $this->assertEquals($word, $string->toLower());
    }

    public function testStringIsNotLower(): void
    {
        $faker = Factory::create();

        $word = strtoupper($faker->word());
        $string = StringVOMother::create($word);

        $this->assertNotEquals($word, $string->toLower());
    }

    public function testStringIsUpper(): void
    {
        $faker = Factory::create();

        $word = strtoupper($faker->word());
        $string = StringVOMother::create($word);

        $this->assertEquals($word, $string->toUpper());
    }

    public function testStringIsNotUpper(): void
    {
        $faker = Factory::create();

        $word = strtolower($faker->word());
        $string = StringVOMother::create($word);

        $this->assertNotEquals($word, $string->toUpper());
    }

    public function testCapitalizeString(): void
    {
        $faker = Factory::create();

        $word = ucfirst(strtolower($faker->word()));
        $string = StringVOMother::create($word);

        $this->assertEquals($word, $string->capitalize());
    }

    public function testEqual(): void
    {
        $faker = Factory::create();

        $value = $faker->word();
        $voA = StringVOMother::create($value);
        $voB = StringVOMother::create($value);

        $this->assertTrue($voA->equal($voB));
    }

    public function testNotEqual(): void
    {
        $faker = Factory::create();

        $voA = StringVOMother::random();
        $voB = StringVOMother::random();

        $this->assertFalse($voA->equal($voB));
    }
}
