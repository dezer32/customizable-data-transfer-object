<?php

declare(strict_types=1);

namespace Mafin\DTO\Casters;

use MyCLabs\Enum\Enum;

class EnumValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        foreach ($allowedTypes as $type) {
            if (!is_object($value) && class_exists($type) && in_array(Enum::class, class_parents($type), true)) {
                return $type::from($value);
            }
        }
        return parent::castValue($value, $allowedTypes);
    }
}
