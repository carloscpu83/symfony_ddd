<?php

declare(strict_types=1);

namespace App\DDD\VOs\BasicVOs;

use App\DDD\VOs\PrimitiveVOs\FloatVO;

final class AmountVO
{
    private FloatVO $floatVo;

    /**
     * @param FloatVO $floatVo
     */
    private function __construct(FloatVO $floatVo)
    {
        $this->floatVo = $floatVo;
    }

    /**
     * @param FloatVO $floatVo
     * @return self
     */
    public static function fromFloatVo(FloatVO $floatVo): self
    {
        return new static($floatVo);
    }

    /**
     * @return FloatVO
     */
    public function value(): FloatVO
    {
        return $this->floatVo;
    }

    /**
     * @param AmountVO $amount
     * @return boolean
     */
    public function equal(AmountVO $amount): bool
    {
        return $this->floatVo->equal($amount->value());
    }
}
