<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\StringVO;
use InvalidArgumentException;

class Password extends StringVO
{
    private const MIN_LENGTH = 5;
    private const MAX_LENGTH = 20;

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
        $length = strlen($value);

        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new InvalidArgumentException();
        }
    }
}
