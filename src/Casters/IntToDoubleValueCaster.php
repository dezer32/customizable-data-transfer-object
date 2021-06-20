<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\FieldValidator;

class IntToDoubleValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        if (is_int($value) && in_array('double', $allowedTypes, true)) {
            return (float) $value;
        }

        return parent::castValue($value, $allowedTypes);
    }
}