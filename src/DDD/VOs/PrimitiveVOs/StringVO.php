<?php

declare(strict_types=1);

namespace App\DDD\VOs\PrimitiveVOs;

abstract class StringVO
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toLower(): string
    {
        return strtolower($this->value);
    }

    /**
     * @return string
     */
    public function capitalize(): string
    {
        return ucfirst(strtolower($this->value));
    }

    /**
     * @return string
     */
    public function toUpper(): string
    {
        return strtoupper($this->value);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return self
     */
    public static function fromValue(string $value): self
    {
        return new static($value);
    }

    /**
     * @param string $value
     * @return boolean
     */
    public function equal(string $value): bool
    {
        return $this->value === $value;
    }
}
