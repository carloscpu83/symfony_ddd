<?php

declare(strict_types=1);

namespace App\DDD\VOs\PrimitiveVOs;

abstract class FloatVO
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
    public static function fromPrimitiveValue(float $value): self
    {
        return new static($value);
    }

    /**
     * @return float
     */
    public function primitiveValue(): float
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

    /**
     * @param float $value
     * @return boolean
     */
    public function equal(float $value): bool
    {
        return $this->value === $value;
    }

    /**
     * @param float $value
     * @return self
     */
    public function addPrimitive(float $value): self
    {
        return $this->fromPrimitiveValue(
            (float)bcdiv(
                (string)($this->value + $value),
                '1',
                self::DECIMAL_DIGITS
            )
        );
    }
}
