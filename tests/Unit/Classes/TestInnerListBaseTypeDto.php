<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\CustomizableDataTransferObject;

class TestInnerListBaseTypeDto extends CustomizableDataTransferObject
{
    public TestBaseTypeDtoList $var;
}