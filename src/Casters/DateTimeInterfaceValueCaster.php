<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Carbon\Carbon;
use DateTimeInterface;
use Spatie\DataTransferObject\FieldValidator;

class DateTimeInterfaceValueCaster extends CustomizableValueCaster
{
    public function cast($value, FieldValidator $validator)
    {
        if (in_array(DateTimeInterface::class, $validator->allowedTypes, true)) {
            return Carbon::parse($value)->toDateTime();
        }

        return parent::cast($value, $validator);
    }
}