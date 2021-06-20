<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use DateTimeInterface;

class DateTimeInterfaceValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        if (
            in_array(DateTimeInterface::class, $allowedTypes, true)
            && !is_subclass_of($value, DateTimeInterface::class)
        ) {
            return new \DateTime($value);
        }

        return parent::castValue($value, $allowedTypes);
    }
}