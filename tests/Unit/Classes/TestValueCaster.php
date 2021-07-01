<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\Casters\CustomizableValueCaster;
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