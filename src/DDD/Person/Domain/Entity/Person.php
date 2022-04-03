<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\Entity;

use App\DDD\Person\Domain\ValueObject\Age;
use App\DDD\Person\Domain\ValueObject\Name;
use App\DDD\Person\Domain\ValueObject\Password;

class Person
{
    private Name $name;
    private Age $age;
    private Password $password;

    /**
     * @param Name $name
     * @param Age $age
     * @param Password $password
     */
    private function __construct(Name $name, Age $age, Password $password)
    {
        $this->name = $name;
        $this->age = $age;
        $this->password = $password;
    }

    /**
     * @param Name $name
     * @param Age $age
     * @param Password $password
     * @return self
     */
    public static function instantiate(Name $name, Age $age, Password $password): self
    {
        return new static($name, $age, $password);
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
     * @return Password
     */
    public function password(): Password
    {
        return $this->password;
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
