<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\ValueObject;

use InvalidArgumentException;
use App\DDD\VOs\PrimitiveVOs\StringVO;

final class Currency extends StringVO
{
    private StringVO $stringVo;

    /**
     * @return StringVO
     */
    public function primitiveValue(): StringVO
    {
        return $this->stringVo;
    }


    /**
     * @param StringVO $stringVO
     */
    private function __construct(StringVO $stringVO)
    {
        $this->stringVo = $stringVO;
    }

    /**
     * @param StringVO $stringVO
     * @throws InvalidArgumentException
     * @return self
     */
    public static function fromString(StringVO $stringVO): self
    {
        self::checkIsoCode($stringVO->value());
        return new static($stringVO);
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
