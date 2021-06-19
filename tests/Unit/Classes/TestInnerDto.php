<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use Dezer\CustomizableDataTransferObject\CustomizableDataTransferObject;

class TestInnerDto extends CustomizableDataTransferObject
{
    public ?TestDto $var;
}