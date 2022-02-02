<?php

declare(strict_types=1);

namespace App\DDD\PrimitiveVOs;

class IntegerVO
{
    /**
     * @var int
     */
    protected $value;

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
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param integer $value
     * @return self
     */
    public static function fromInt(int $value): self
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

}
