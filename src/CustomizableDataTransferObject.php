<?php

declare(strict_types=1);

namespace Mafin\DTO;

use Mafin\DTO\Casters\BaseTypeCollectionValueCaster;
use Mafin\DTO\Casters\BoolValueCaster;
use Mafin\DTO\Casters\CustomizableValueCaster;
use Mafin\DTO\Casters\DateTimeInterfaceValueCaster;
use Mafin\DTO\Casters\EnumValueCaster;
use Mafin\DTO\Casters\IntToDoubleValueCaster;
use Mafin\DTO\Casters\UuidInterfaceValueCaster;
use Mafin\DTO\Casters\ValueCaster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectCollection;
use Spatie\DataTransferObject\FieldValidator;
use Spatie\DataTransferObject\ValueCaster as DefaultValueCaster;

class CustomizableDataTransferObject extends DataTransferObject
{
    protected function castValue(DefaultValueCaster $valueCaster, FieldValidator $fieldValidator, $value)
    {
        if (
            null === $value
            || is_subclass_of($value, DataTransferObject::class)
            || is_subclass_of($value, DataTransferObjectCollection::class)
        ) {
            return $value;
        }

        if (is_array($value)) {
            return $valueCaster->cast($value, $fieldValidator);
        }

        return $valueCaster->castValue($value, $fieldValidator->allowedTypes);
    }

    protected function getValueCaster(?CustomizableValueCaster $valueCaster = null
    ): CustomizableValueCaster {
        return ValueCasterCache::cache(
            self::class,
            function (): CustomizableValueCaster {
                $valueCaster = new ValueCaster();
                $valueCaster->setNext(new DateTimeInterfaceValueCaster())
                            ->setNext(new IntToDoubleValueCaster())
                            ->setNext(new BoolValueCaster())
                            ->setNext(new EnumValueCaster())
                            ->setNext(new UuidInterfaceValueCaster())
                            ->setNext(new BaseTypeCollectionValueCaster());

                return $valueCaster;
            }
        );
    }
}