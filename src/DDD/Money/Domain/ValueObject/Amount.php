<?php

declare(strict_types=1);

namespace App\DDD\Money\Domain\ValueObject;

use App\DDD\VOs\PrimitiveVOs\FloatVO;

final class Amount extends FloatVO
{
    private FloatVO $floatVo;

    /**
     * @return FloatVO
     */
    public function primitiveValue(): FloatVO
    {
        return $this->floatVo;
    }

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
    public static function fromFloat(FloatVO $floatVo): self
    {
        return new static($floatVo);
    }
}
