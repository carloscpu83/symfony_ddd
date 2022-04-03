<?php

declare(strict_types=1);

namespace App\DDD\Person\Domain\Service;

use App\DDD\Person\Domain\ValueObject\Password;

class CreateMD5Password
{
    /**
     * @param string $value
     * @return Password
     */
    public function execute(string $value): Password
    {
        return Password::fromString(md5($value));
    }
}
