<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\Entity;

use App\DDD\Money\Domain\ValueObject\AmountVO;
use App\DDD\Money\Domain\ValueObject\CurrencyVO;

class Money
{
    private CurrencyVO $currencyVO;
    private AmountVO $amountVO;

    /**
     * @param CurrencyVO $currencyVO
     * @param AmountVO $amountVO
     */
    private function __construct(CurrencyVO $currencyVO, AmountVO $amountVO)
    {
        $this->currencyVO = $currencyVO;
        $this->amountVO = $amountVO;
    }

    /**
     * @param CurrencyVO $currencyVO
     * @param AmountVO $amountVO
     * @return self
     */
    public static function instantiate(CurrencyVO $currencyVO, AmountVO $amountVO): self
    {
        return new static($currencyVO, $amountVO);
    }
}
