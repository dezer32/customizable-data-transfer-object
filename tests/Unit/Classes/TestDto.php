<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use DateTimeInterface;
use Mafin\DTO\CustomizableDataTransferObject;

class TestDto extends CustomizableDataTransferObject
{
    public ?bool $bool;
    public ?int $int;
    public ?float $float;
    public ?DateTimeInterface $date;
}