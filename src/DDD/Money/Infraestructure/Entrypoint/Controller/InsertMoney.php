<?php

declare(strict_types=1);

namespace App\DDD\Money\Infraestructure\Entrypoint\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\DDD\Money\Domain\Entity\Money;
use App\DDD\Money\Domain\ValueObject\AmountVO;
use App\DDD\Money\Domain\ValueObject\CurrencyVO;
use App\DDD\VOs\PrimitiveVOs\FloatVO;
use App\DDD\VOs\PrimitiveVOs\StringVO;

class InsertMoney extends AbstractController
{
    public function __invoke()
    {
        $money = Money::instantiate(
            CurrencyVO::fromStringVo(StringVO::fromString('EUR')),
            AmountVO::fromFloatVo(FloatVO::fromValue(15.667))
        );
    }
}
