<?php

declare(strict_types=1);

namespace App\tests\DDD\VOs\BasicVOs;

use PHPUnit\Framework\TestCase;
use App\DDD\Money\Domain\ValueObject\AmountVO;
use App\DDD\VOs\PrimitiveVOs\FloatVO;
use Faker\Factory;

class AmountVOTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $faker = Factory::create();
        $this->assertInstanceOf(
            AmountVO::class,
            AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)))
        );
    }

    /**
     * @return void
     */
    public function testInstanceOfFloatVo(): void
    {
        $faker = Factory::create();
        $amount = AmountVO::fromFloatVo(FloatVO::fromValue($faker->randomFloat(2)));
        $this->assertInstanceOf(FloatVO::class, $amount->value());
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $faker = Factory::create();
        $floatNumber = $faker->randomFloat(2);
        $amountA = AmountVO::fromFloatVo(FloatVO::fromValue($floatNumber));
        $amountB = AmountVO::fromFloatVo(FloatVO::fromValue($floatNumber));
        $this->assertTrue($amountA->equal($amountB));
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $faker = Factory::create();
        $floatNumberA = $faker->randomFloat(2);
        $floatNumberB = $faker->randomFloat(2);
        $amountA = AmountVO::fromFloatVo(FloatVO::fromValue($floatNumberA));
        $amountB = AmountVO::fromFloatVo(FloatVO::fromValue($floatNumberB));
        $this->assertFalse($amountA->equal($amountB));
    }
}
