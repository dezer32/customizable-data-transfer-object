<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\FieldValidator;

class ValueCaster extends CustomizableValueCaster
{
    public function cast($value, FieldValidator $validator)
    {
        if (!is_array($value)) {
            return parent::cast($value, $validator);
        }

        if (!$this->shouldBeCastToCollection($value)) {
            return $this->castValue($value, $validator->allowedTypes);
        }

        $values = $this->castCollection($value, $validator->allowedArrayTypes);
        $collectionType = $this->collectionType($validator->allowedTypes);

        return $collectionType ? new $collectionType($values) : $values;
    }
}