<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit\Classes;

use DateTimeInterface;
use Dezer\CustomizableDataTransferObject\CustomizableDataTransferObject;

class TestDto extends CustomizableDataTransferObject
{
    public ?bool $bool;
    public ?int $int;
    public ?float $float;
    public ?DateTimeInterface $date;
}