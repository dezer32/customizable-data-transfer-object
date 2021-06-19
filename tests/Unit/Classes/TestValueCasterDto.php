<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use Dezer\CustomizableDataTransferObject\Casters\CustomizableValueCaster;
use Dezer\CustomizableDataTransferObject\ValueCasterCache;

class TestValueCasterDto extends TestDto
{
    protected function getValueCaster(?CustomizableValueCaster $valueCaster = null): CustomizableValueCaster
    {
        return ValueCasterCache::cache(
            self::class,
            function (): CustomizableValueCaster {
                $newValueCaster = new TestValueCaster();
                $newValueCaster->setNext(parent::getValueCaster());

                return $newValueCaster;
            }
        );
    }
}