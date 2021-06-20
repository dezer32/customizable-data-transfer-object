<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use Spatie\DataTransferObject\DataTransferObjectCollection;

class TestCollectionCasterDtoList extends DataTransferObjectCollection
{
    public function current(): bool
    {
        return parent::current();
    }
}