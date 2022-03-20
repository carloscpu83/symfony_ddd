<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\FloatVO;

final class Amount extends FloatVO
{
    /**
     * @param float $value
     */
    private function __construct(float $value)
    {
        parent::__construct($value);
    }

    /**
     * @param float $value
     * @return self
     */
    public static function fromFloat(float $value): self
    {
        return new static($value);
    }

    /**
     * @param Amount $amount
     * @return boolean
     */
    public function equals(Amount $amount): bool
    {
        return $this->equal($amount->primitiveValue());
    }

    /**
     * @param Amount $amount
     * @return self
     */
    public function add(Amount $amount)
    {
        //return self::fromFloat($this->addPrimitive($amount->primitiveValue())->primitiveValue());
        $this->value = $this->addPrimitive($amount->primitiveValue())->primitiveValue();
    }
}
