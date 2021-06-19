<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use Dezer\CustomizableDataTransferObject\CustomizableDataTransferObject;

class TestInnerDtoList extends CustomizableDataTransferObject
{
    public TestDtoList $var;
}