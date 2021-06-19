<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject;

use Dezer\CustomizableDataTransferObject\Casters\CustomizableValueCaster;

class ValueCasterCache
{
    private static array $cache = [];

    public static function cache(string $class, \Closure $closure): CustomizableValueCaster
    {
        if (!isset(self::$cache[$class])) {
            self::$cache[$class] = $closure();
        }

        return self::$cache[$class];
    }
}