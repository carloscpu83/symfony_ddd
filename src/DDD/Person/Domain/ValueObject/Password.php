<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\StringVO;
use InvalidArgumentException;

class Password extends StringVO
{
    private const LENGTH = 32;

    private function __construct(string $value)
    {
        $this->isValid($value);
        parent::__construct($value);
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    private function isValid(string $value): void
    {
        if (strlen($value) !==  self::LENGTH) {
            throw new InvalidArgumentException();
        }
    }

    public function equals(Password $otherPassword): bool
    {
        return $this->primitiveValue() === $otherPassword->primitiveValue();
    }
}
