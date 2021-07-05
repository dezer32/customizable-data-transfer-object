<?php

declare(strict_types=1);

namespace Mafin\DTO\Casters;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidInterfaceValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        if (!is_object($value) && in_array(UuidInterface::class, $allowedTypes, true)) {
            return Uuid::fromString($value);
        }

        return parent::castValue($value, $allowedTypes);
    }
}