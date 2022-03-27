<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\Entity;

use App\DDD\Person\Domain\ValueObject\Age;
use App\DDD\Person\Domain\ValueObject\Name;

class Person
{
    private Name $name;
    private Age $age;

    /**
     * @param Name $name
     * @param Age $age
     */
    private function __construct(Name $name, Age $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @param Name $name
     * @param Age $age
     * @return self
     */
    public static function instantiate(Name $name, Age $age): self
    {
        return new static($name, $age);
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * @return Age
     */
    public function age(): Age
    {
        return $this->age;
    }

    /**
     * @param Person $otherPerson
     * @return boolean
     */
    public function equals(Person $otherPerson): bool
    {
        return $this->name->equals($otherPerson->name()) && $this->age->equals($otherPerson->age());
    }
}
