<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit;

use Carbon\Carbon;
use DateTimeInterface;
use Dezer\CustomizableDataTransferObject\Tests\Unit\Classes\TestDto;
use Dezer\CustomizableDataTransferObject\Tests\Unit\Classes\TestInnerDto;
use Dezer\CustomizableDataTransferObject\Tests\Unit\Classes\TestInnerDtoList;
use Dezer\CustomizableDataTransferObject\Tests\Unit\Classes\TestValueCasterDto;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class CustomizableDataTransferObjectTest extends TestCase
{
    private Generator $faker;

    /**
     * @dataProvider validDataToBaseDataTransferObjetProvider
     */
    public function testSuccessCanCreateBaseDto(array $data): void
    {
        $dto = new TestDto($data);

        self::assertIsBool($dto->bool);
        self::assertIsInt($dto->int);
        self::assertIsFloat($dto->float);
        self::assertInstanceOf(DateTimeInterface::class, $dto->date);
    }

    public function validDataToBaseDataTransferObjetProvider(): array
    {
        $this->faker ??= Factory::create('ru_RU');

        return [
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomDigit(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')->format('d.m.Y')
                ]
            ],
            [
                [
                    'bool' => 1,
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => Carbon::parse($this->faker->dateTime())
                ]
            ]
        ];
    }

    /**
     * @dataProvider validDataToNewValueCasterProvider
     */
    public function testSuccessCanAddNewValueCaster(array $data): void
    {
        $dto = new TestValueCasterDto($data);

        self::assertEquals(!$data['bool'], $dto->bool);
        self::assertIsInt($dto->int);
        self::assertIsFloat($dto->float);
        self::assertInstanceOf(DateTimeInterface::class, $dto->date);
    }

    public function validDataToNewValueCasterProvider(): array
    {
        $this->faker ??= Factory::create('ru_RU');

        return [
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomDigit(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')->format('d.m.Y')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => Carbon::parse($this->faker->dateTime())
                ]
            ]
        ];
    }

    /**
     * @dataProvider validDataToBaseDataTransferObjetProvider
     */
    public function testSuccessCanCastingInnerDto(array $data)
    {
        $dto = new TestInnerDto(['var' => $data]);

        self::assertIsBool($dto->var->bool);
        self::assertIsInt($dto->var->int);
        self::assertIsFloat($dto->var->float);
        self::assertInstanceOf(DateTimeInterface::class, $dto->var->date);
    }

    /**
     * @dataProvider validDataToBaseDataTransferObjetProvider
     */
    public function testSuccessCanCastingInnerList(array $data)
    {
        $dto = new TestInnerDtoList(['var' => [$data]]);

        self::assertIsBool($dto->var->current()->bool);
        self::assertIsInt($dto->var->current()->int);
        self::assertIsFloat($dto->var->current()->float);
        self::assertInstanceOf(DateTimeInterface::class, $dto->var->current()->date);
    }

    /**
     * @dataProvider validDataWithNull
     */
    public function testSuccesCanCreateNullBaseDto(array $data)
    {
        $dto = new TestDto($data);

        self::assertEquals($data, $dto->toArray());
    }

    public function validDataWithNull(): array
    {
        $this->faker = Factory::create('ru_RU');

        return [
            [
                [
                    'bool' => null,
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => null,
                    'float' => $this->faker->randomFloat(),
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => null,
                    'date' => $this->faker->dateTime('+30 years')
                ]
            ],
            [
                [
                    'bool' => $this->faker->boolean(),
                    'int' => $this->faker->randomDigit(),
                    'float' => $this->faker->randomFloat(),
                    'date' => null
                ]
            ],
        ];
    }

    public function testSuccessCanCreateNullInnerDto()
    {
        $dto = new TestInnerDto(['var' => null]);

        self::assertNull($dto->var);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create('ru_RU');
    }
}