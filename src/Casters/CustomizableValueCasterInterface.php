<?php

declare(strict_types=1);

namespace Mafin\DTO\Casters;

use Spatie\DataTransferObject\FieldValidator;

interface CustomizableValueCasterInterface
{
    public function castValue($value, array $allowedTypes);

    public function castCollection($values, array $allowedArrayTypes);

    public function setNext(CustomizableValueCasterInterface $nextValueCaster);
}