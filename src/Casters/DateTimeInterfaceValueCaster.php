<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Carbon\Carbon;
use DateTimeInterface;

class DateTimeInterfaceValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        if (in_array(DateTimeInterface::class, $allowedTypes, true)) {
            return Carbon::parse($value)->toDateTime();
        }

        return parent::castValue($value, $allowedTypes);
    }
}