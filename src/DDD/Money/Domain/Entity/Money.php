<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

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
}
