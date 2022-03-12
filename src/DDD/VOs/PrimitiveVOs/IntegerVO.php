<?php

declare(strict_types=1);

namespace App\DDD\VOs\PrimitiveVOs;

abstract class IntegerVO
{
    /**
     * @var int
     */
    private $value;

    /**
     * @param int $value
     */
    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function primitiveValue(): int
    {
        return $this->value;
    }

    /**
     * @param integer $value
     * @return self
     */
    public static function fromPrimitiveValue(int $value): self
    {
        return new static($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @param integer $value
     * @return boolean
     */
    public function equal(int $value): bool
    {
        return $this->value === $value;
    }
}
