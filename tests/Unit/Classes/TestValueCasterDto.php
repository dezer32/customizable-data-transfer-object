<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\Casters\CustomizableValueCaster;
use Mafin\DTO\ValueCasterCache;

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