<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\IntegerVO;
use Doctrine\Common\Cache\Psr6\InvalidArgument;
use InvalidArgumentException;

class Age extends IntegerVO
{
    private const ADULT_AGE = 18;
    /**
     * @param integer $value
     */
    private function __construct(int $value)
    {
        $this->validAge($value);
        parent::__construct($value);
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
     * @return boolean
     */
    public function isAdult(): bool
    {
        return self::ADULT_AGE <= $this->primitiveValue();
    }

    /**
     * @param Age $otherAge
     * @return boolean
     */
    public function equals(Age $otherAge): bool
    {
        return $this->equal($otherAge->primitiveValue());
    }

    /**
     * @param integer $value
     * @return void
     * @throws InvalidArgumentException
     */
    private function validAge(int $value): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException();
        }
    }
}
