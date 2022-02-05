<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use InvalidArgumentException;
use App\DDD\Money\Domain\ValueObject\AmountVO;
use App\DDD\Money\Domain\ValueObject\CurrencyVO;

class Money
{
    private CurrencyVO $currency;
    private AmountVO $amount;

    /**
     * @param CurrencyVO $currency
     * @param AmountVO $amount
     */
    private function __construct(CurrencyVO $currency, AmountVO $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * @param CurrencyVO $currency
     * @param AmountVO $amount
     * @return self
     */
    public static function instantiate(CurrencyVO $currency, AmountVO $amount): self
    {
        return new static($currency, $amount);
    }

    /**
     * @return CurrencyVo
     */
    public function currency(): CurrencyVo
    {
        return $this->currency;
    }

    /**
     * @return AmountVO
     */
    public function amount(): AmountVO
    {
        return $this->amount;
    }

    /**
     * @param Money $otherMoney
     * @return boolean
     */
    public function equal(Money $otherMoney): bool
    {
        return $this->currency->equal($otherMoney->currency()) && $this->amount->equal($otherMoney->amount());
    }

    /**
     * @param Money $otherMoney
     * @return self
     * @throws InvalidArgumentException
     */
    public function add(Money $otherMoney): self
    {
        if (!$this->currency->equal($otherMoney->currency())) {
            throw new InvalidArgumentException();
        }

        return $this->instantiate(
            $this->currency(),
            $this->amount->add($otherMoney->amount())
        );
    }
}
