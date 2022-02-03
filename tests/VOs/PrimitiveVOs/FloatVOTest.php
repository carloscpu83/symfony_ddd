<?php

declare(strict_types=1);

namespace App\tests\VOs\PrimitiveVOs;

use App\DDD\VOs\PrimitiveVOs\FloatVO;
use PHPUnit\Framework\TestCase;

class FloatVOTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            FloatVO::class,
            FloatVO::fromValue(1.123456)
        );
    }

    /**
     * @return void
     */
    public function testIsFloatValue(): void
    {
        $float = FloatVO::fromValue(1.123456);
        $this->assertIsFloat($float->value());
    }

    /**
     * @return void
     */
    public function testLargeDecimals(): void
    {
        $float = FloatVO::fromValue(1.123456);
        $this->assertEquals($float->value(), 1.12);
    }

    /**
     * @return void
     */
    public function testShortDecimals(): void
    {
        $float = FloatVO::fromValue(1.1);
        $this->assertEquals($float->value(), 1.10);
    }

    /**
     * @return void
     */
    public function testWithoutDecimals(): void
    {
        $float = FloatVO::fromValue(1);
        $this->assertEquals($float->value(), 1.00);
    }

    /**
     * @return void
     */
    public function testWithoutDecimalsToString()
    {
        $float = FloatVO::fromValue(1);
        $this->assertEquals($float->__toString(), '1,00');
    }

    /**
     * @return void
     */
    public function testShortDecimalsToString(): void
    {
        $float = FloatVO::fromValue(1.1);
        $this->assertEquals($float->__toString(), '1,10');
    }

    /**
     * @return void
     */
    public function testLargeDecimalsToString(): void
    {
        $float = FloatVO::fromValue(1.123456);
        $this->assertEquals($float->__toString(), '1,12');
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $value = 1.23456789;
        $voA = FloatVO::fromValue($value);
        $voB = FloatVO::fromValue($value);
        $this->assertTrue($voA->equal($voB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $valueA = 1.23456789;
        $valueB = 9.87654321;
        $voA = FloatVO::fromValue($valueA);
        $voB = FloatVO::fromValue($valueB);
        $this->assertFalse($voA->equal($voB));
    }
}
