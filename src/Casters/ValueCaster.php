<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\DataTransferObject;

class ValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        $castTo = null;

        foreach ($allowedTypes as $type) {
            if (!is_subclass_of($type, DataTransferObject::class)) {
                continue;
            }

            $castTo = $type;

            break;
        }

        if (!$castTo) {
            return parent::castValue($value, $allowedTypes);
        }

        return new $castTo($value);
    }
}