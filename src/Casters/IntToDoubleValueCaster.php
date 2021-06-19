<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\FieldValidator;

class IntToDoubleValueCaster extends CustomizableValueCaster
{
    public function cast($value, FieldValidator $validator)
    {
        if (is_int($value) && in_array('double', $validator->allowedTypes, true)) {
            return (float) $value;
        }

        return parent::cast($value, $validator);
    }
}