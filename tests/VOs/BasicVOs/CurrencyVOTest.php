<?php

declare(strict_types=1);

namespace App\tests\VOs\BasicVOs;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\DDD\VOs\BasicVOs\CurrencyVO;
use App\DDD\VOs\PrimitiveVOs\StringVO;

class CurrencyVOTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $currencyVO = CurrencyVO::fromStringVo(StringVO::fromString('EUR'));
        $this->assertInstanceOf(CurrencyVO::class, $currencyVO);
    }

    /**
     * @return void
     */
    public function testInstanceOfStringVo(): void
    {
        $currencyVO = CurrencyVO::fromStringVo(StringVO::fromString('EUR'));
        $this->assertInstanceOf(StringVO::class, $currencyVO->value());
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $currencyVoA = CurrencyVO::fromStringVo(StringVO::fromString('EUR'));
        $currencyVoB = CurrencyVO::fromStringVo(StringVO::fromString('EUR'));
        $this->assertTrue($currencyVoA->equal($currencyVoB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $currencyVoA = CurrencyVO::fromStringVo(StringVO::fromString('EUR'));
        $currencyVoB = CurrencyVO::fromStringVo(StringVO::fromString('USD'));
        $this->assertFalse($currencyVoA->equal($currencyVoB));
    }

    /**
     * @return void
     */
    public function testIsoCodeNotValid(): void
    {
        $faker = Factory::create();
        $this->expectException(InvalidArgumentException::class);
        CurrencyVO::fromStringVo(StringVO::fromString($faker->word()));
    }
}
