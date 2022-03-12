<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use InvalidArgumentException;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\DDD\Money\Domain\ValueObject\Currency;

class Money
{
    private Currency $currency;
    private Amount $amount;

    /**
     * @param Currency $currency
     * @param Amount $amount
     */
    private function __construct(Currency $currency, Amount $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * @param Currency $currency
     * @param Amount $amount
     * @return self
     */
    public static function instantiate(Currency $currency, Amount $amount): self
    {
        return new static($currency, $amount);
    }

    /**
     * @return Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return Amount
     */
    public function amount(): Amount
    {
        return $this->amount;
    }

    /**
     * @param Money $otherMoney
     * @return boolean
     */
    public function equal(Money $otherMoney): bool
    {
        return $this->currency->equals($otherMoney->currency()) && $this->amount->equals($otherMoney->amount());
    }

    /**
     * @param Money $otherMoney
     * @return self
     * @throws InvalidArgumentException
     */
    public function add(Money $otherMoney): self
    {
        if (!$this->currency->equal($otherMoney->currency()->primitiveValue())) {
            throw new InvalidArgumentException();
        }

        return $this->instantiate(
            $this->currency(),
            $this->amount->add($otherMoney->amount())
        );
    }
}
