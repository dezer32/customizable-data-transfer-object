<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Casters;

use Spatie\DataTransferObject\DataTransferObjectCollection;

class BaseTypeCollectionValueCaster extends CustomizableValueCaster
{
    public function castValue($value, array $allowedTypes)
    {
        foreach ($allowedTypes as $type) {
            if (is_array($value) && is_subclass_of($type, DataTransferObjectCollection::class)) {
                $collectionType = $this->collectionType($allowedTypes);

                return $collectionType ? new $collectionType($value) : $value;
            }
        }
        return parent::castValue($value, $allowedTypes);
    }
}