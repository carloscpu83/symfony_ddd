<?php

declare(strict_types=1);

namespace App\DDD\PrimitiveVOs;

class FloatVO
{
    private const DECIMAL_DIGITS = 2;

    /**
     * @var float
     */
    protected $value;

    /**
     * @param float $value
     */
    protected function __construct(float $value)
    {
        $this->value = self::cutDecimals($value);
    }

    /**
     * @param float $value
     * @return float
     */
    private static function cutDecimals(float $value): float
    {
        return (float)bcdiv((string)$value, '1', self::DECIMAL_DIGITS);
    }

    /**
     * @param float $value
     * @return self
     */
    public static function fromValue(float $value): self
    {
        return new static($value);
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return number_format($this->value, 2, ',', '');
    }
}
