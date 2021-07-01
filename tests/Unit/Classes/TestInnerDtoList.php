<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\CustomizableDataTransferObject;

class TestInnerDtoList extends CustomizableDataTransferObject
{
    public TestDtoList $var;
}