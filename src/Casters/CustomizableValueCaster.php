<?php

declare(strict_types=1);

namespace Mafin\DTO\Casters;

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

    public function castValue($value, array $allowedTypes)
    {
        if (isset($this->nextValueCaster) && $this->nextValueCaster !== null && $value !== null) {
            $value = $this->nextValueCaster->castValue($value, $allowedTypes);
        }

        return $value;
    }

    public function castCollection($values, array $allowedArrayTypes)
    {
        if (isset($this->nextValueCaster) && $this->nextValueCaster !== null && $values !== null) {
            $this->nextValueCaster->castCollection($values, $allowedArrayTypes);
        }

        return parent::castCollection($values, $allowedArrayTypes);
    }
}