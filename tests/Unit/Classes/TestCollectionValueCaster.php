<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\Casters\CustomizableValueCaster;

class TestCollectionValueCaster extends CustomizableValueCaster
{
    public function castCollection($values, array $allowedArrayTypes)
    {
        if (in_array('boolean', $allowedArrayTypes, true)) {
            $casts = [];

            foreach ($values as $value) {
                $casts[] = !$value[0];
            }

            return $casts;
        }

        return parent::castCollection($values, $allowedArrayTypes);
    }
}