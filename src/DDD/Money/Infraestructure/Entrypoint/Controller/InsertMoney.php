<?php

declare(strict_types=1);

namespace App\DDD\Money\Infraestructure\Entrypoint\Controller;

use App\DDD\VOs\PrimitiveVOs\FloatVO;
use App\DDD\Money\Domain\Entity\Money;
use App\DDD\VOs\PrimitiveVOs\StringVO;
use App\DDD\Money\Domain\ValueObject\Amount;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InsertMoney extends AbstractController
{
    public function __invoke()
    {
        $money = Money::instantiate(
            Currency::fromString(StringVO::fromString('EUR')),
            Amount::fromFloat(FloatVO::fromValue(15.667))
        );
    }
}
