<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use Dezer\CustomizableDataTransferObject\Casters\CustomizableValueCaster;
use Spatie\DataTransferObject\FieldValidator;

class TestValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        if (is_bool($value)) {
            return !$value;
        }

        return parent::castValue($value, $allowedTypes);
    }
}