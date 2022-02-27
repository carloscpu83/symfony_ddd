<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Money\Domain\Entity;

use App\DDD\Money\Domain\Entity\Money;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\DDD\Money\Domain\ValueObject\Currency;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\AmountMother;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\CurrencyMother;

final class MoneyMother
{
    /**
     * @param Currency $currency
     * @param Amount $amount
     * @return Money
     */
    public static function create(Currency $currency, Amount $amount): Money
    {
        return Money::instantiate($currency, $amount);
    }

    /**
     * @param integer $amountLength
     * @return Money
     */
    public static function random(int $amountLength = 2): Money
    {
        return self::create(
            CurrencyMother::random(),
            AmountMother::random($amountLength)
        );
    }
}
