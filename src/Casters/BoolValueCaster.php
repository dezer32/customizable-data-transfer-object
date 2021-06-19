<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\FieldValidator;

class BoolValueCaster extends CustomizableValueCaster
{
    public function cast($value, FieldValidator $validator)
    {
        if (is_int($value) && in_array($value, [0, 1]) && in_array('boolean', $validator->allowedTypes, true)) {
            return (bool) $value;
        }

        return parent::cast($value, $validator);
    }
}