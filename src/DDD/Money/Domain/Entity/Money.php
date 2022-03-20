<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use InvalidArgumentException;
use App\DDD\Money\Domain\ValueObject\Amount;
use App\DDD\Money\Domain\ValueObject\Currency;
use App\DDD\Money\Domain\ValueObject\Uuid;

class Money
{
    private Uuid $uuid;
    private Currency $currency;
    private Amount $amount;

    /**
     * @param Uuid $uuid
     * @param Currency $currency
     * @param Amount $amount
     */
    private function __construct(Uuid $uuid, Currency $currency, Amount $amount)
    {
        $this->uuid = $uuid;
        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * @param Uuid $uuid
     * @param Currency $currency
     * @param Amount $amount
     * @return self
     */
    public static function instantiate(Uuid $uuid, Currency $currency, Amount $amount): self
    {
        return new static($uuid, $currency, $amount);
    }

    /**
     * @return Uuid
     */
    public function uuid(): Uuid
    {
        return $this->uuid;
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
        return $this->uuid->equals($otherMoney->uuid()) &&
            $this->currency->equals($otherMoney->currency()) &&
            $this->amount->equals($otherMoney->amount());
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
            $this->uuid,
            $this->currency(),
            $this->amount->add($otherMoney->amount())
        );
    }
}
