<?php

declare(strict_types=1);

namespace App\Tests\Mother\DDD\Money\Domain\Entity;

use App\DDD\Money\Domain\Entity\Money;
use App\DDD\Money\Domain\ValueObject\Uuid;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\DDD\Money\Domain\ValueObject\Currency;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\UuidMother;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\AmountMother;
use App\Tests\Mother\DDD\Money\Domain\ValueObject\CurrencyMother;

final class MoneyMother
{
    /**
     * @param Uuid $uuid
     * @param Currency $currency
     * @param Amount $amount
     * @return Money
     */
    public static function create(Uuid $uuid, Currency $currency, Amount $amount): Money
    {
        return Money::instantiate($uuid, $currency, $amount);
    }

    /**
     * @param integer $amountLength
     * @return Money
     */
    public static function random(int $amountLength = 2): Money
    {
        return self::create(
            UuidMother::random(),
            CurrencyMother::random(),
            AmountMother::random($amountLength)
        );
    }
}
