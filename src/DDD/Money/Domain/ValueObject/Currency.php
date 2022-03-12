<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\ValueObject;

use InvalidArgumentException;
use App\DDD\VOs\PrimitiveVOs\StringVO;

final class Currency extends StringVO
{
    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return self
     */
    public static function fromString(string $value): self
    {
        self::checkIsoCode($value);
        return new static($value);
    }

    /**
     * @param Currency $currency
     * @return boolean
     */
    public function equals(Currency $currency): bool
    {
        return $this->equal($currency->primitiveValue());
    }


    /**
     * @param string $anIsoCode
     * @return void
     * @throws InvalidArgumentException
     */
    private static function checkIsoCode(string $isoCode): void
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
