<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\FieldValidator;

interface CustomizableValueCasterInterface
{
    public function cast($value, FieldValidator $validator);

    public function setNext(CustomizableValueCasterInterface $nextValueCaster);
}