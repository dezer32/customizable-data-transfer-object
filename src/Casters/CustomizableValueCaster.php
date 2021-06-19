<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\FieldValidator;
use Spatie\DataTransferObject\ValueCaster;

class CustomizableValueCaster extends ValueCaster implements CustomizableValueCasterInterface
{
    private CustomizableValueCasterInterface $nextValueCaster;

    public function setNext(CustomizableValueCasterInterface $nextValueCaster)
    {
        $this->nextValueCaster = $nextValueCaster;

        return $nextValueCaster;
    }

    public function cast($value, FieldValidator $validator)
    {
        if (isset($this->nextValueCaster) && $this->nextValueCaster !== null) {
            $value = $this->nextValueCaster->cast($value, $validator);
        }

        return $value;
    }
}