<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use Mafin\DTO\CustomizableDataTransferObject;
use Ramsey\Uuid\UuidInterface;

class TestUuidDto extends CustomizableDataTransferObject
{
    public UuidInterface $test;
}