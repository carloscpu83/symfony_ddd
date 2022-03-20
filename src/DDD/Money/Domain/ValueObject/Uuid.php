<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as UuidGenerator;

final class Uuid
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->assertValidUuid($value);
        $this->value = $value;
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
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return void
     * @throws InvalidArgumentException
     */
    private function assertValidUuid(string $value): void
    {
        if (!UuidGenerator::isValid($value)) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return self
     */
    public function randomGeneration(): self
    {
        return self::fromValue(UuidGenerator::uuid4()->__toString());
    }

    /**
     * @param string $value
     * @return boolean
     */
    public function equals(Uuid $otherUuid): bool
    {
        return $this->value === $otherUuid->value();
    }
}
