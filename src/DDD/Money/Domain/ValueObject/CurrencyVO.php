<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\StringVO;
use InvalidArgumentException;

final class CurrencyVO
{
    private StringVO $stringVo;

    /**
     * @param StringVO $stringVO
     */
    private function __construct(StringVO $stringVO)
    {
        $this->checkIsoCode($stringVO->value());
        $this->stringVo = $stringVO;
    }

    /**
     * @param StringVO $stringVO
     * @return self
     */
    public static function fromStringVo(StringVO $stringVO): self
    {
        return new static($stringVO);
    }

    /**
     * @return StringVO
     */
    public function value(): StringVO
    {
        return $this->stringVo;
    }

    /**
     * @param CurrencyVO $currencyVO
     * @return boolean
     */
    public function equal(CurrencyVO $currencyVO): bool
    {
        return $this->stringVo->equal($currencyVO->value());
    }

    /**
     * @param string $anIsoCode
     * @return void
     * @throws InvalidArgumentException
     */
    private function checkIsoCode(string $isoCode): void
    {
        $isoCodeList = [
            'EUR',
            'USD'
        ];

        if (!in_array($isoCode, $isoCodeList)) {
            throw new InvalidArgumentException();
        }
    }
}
