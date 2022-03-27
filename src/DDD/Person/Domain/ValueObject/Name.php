<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\StringVO;
use InvalidArgumentException;

class Name extends StringVO
{
    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->validName($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @return self
     */
    public static function fromString(string $value): self
    {
        return new static($value);
    }

    /**
     * @param string $value
     * @return boolean
     * @throws InvalidArgumentException
     */
    private function validName(string $value)
    {
        if (empty($value) || strlen($value) < 10) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param Name $otherName
     * @return boolean
     */
    public function equals(Name $otherName): bool
    {
        return $this->equal($otherName->primitiveValue());
    }
}
