<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\Casters\CustomizableValueCaster;
use Mafin\DTO\CustomizableDataTransferObject;
use Mafin\DTO\ValueCasterCache;

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