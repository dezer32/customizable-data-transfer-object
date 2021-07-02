<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit\Classes;

use MyCLabs\Enum\Enum;

/**
 * Class TestEnum
 *
 * @method static self TEST()
 *
 * @package Mafin\DTO\Tests\Unit\Classes
 */
class TestEnum extends Enum
{
    private const TEST = 'test';
}