<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use Dezer\CustomizableDataTransferObject\Casters\CustomizableValueCaster;
use Dezer\CustomizableDataTransferObject\CustomizableDataTransferObject;
use Dezer\CustomizableDataTransferObject\ValueCasterCache;

class TestInnerCollectionCasterDtoList extends CustomizableDataTransferObject
{
    public TestCollectionCasterDtoList $var;

    protected function getValueCaster(?CustomizableValueCaster $valueCaster = null): CustomizableValueCaster
    {
        return ValueCasterCache::cache(
            self::class,
            function (): CustomizableValueCaster {
                $newValueCaster = new TestCollectionValueCaster();
                $newValueCaster->setNext(parent::getValueCaster());

                return $newValueCaster;
            }
        );
    }
}