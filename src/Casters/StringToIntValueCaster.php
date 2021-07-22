<?php

declare(strict_types=1);

namespace Mafin\DTO\Casters;

class StringToIntValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        if (is_string($value) && in_array('integer', $allowedTypes, true) && (string) (int) $value === $value) {
            return (int) $value;
        }
        return parent::castValue($value, $allowedTypes);
    }
}