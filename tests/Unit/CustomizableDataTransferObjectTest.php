<?php

declare(strict_types=1);

namespace Dezer\CustomizableDataTransferObject\Tests\Unit;

use Carbon\Carbon;
use DateTimeInterface;
use Dezer\CustomizableDataTransferObject\Casters\CustomizableValueCaster;
use Dezer\CustomizableDataTransferObject\CustomizableDataTransferObject;
use Dezer\CustomizableDataTransferObject\ValueCasterCache;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Spatie\DataTransferObject\FieldValidator;

class CustomizableDataTransferObjectTest extends TestCase
{
    private Generator $faker;

    /**
     * @dataProvider validDataToBaseDataTransferObjetProvider
     */
    public function testSuccessCanCreateBaseDto(array $data): void
    {
        $dto = new class($data) extends CustomizableDataTransferObject {
            public bool $bool;
            public int $int;
            public float $float;
            public DateTimeInterface $date;
        };

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
        $dto = new class($data) extends CustomizableDataTransferObject {
            public bool $bool;
            public int $int;
            public float $float;
            public DateTimeInterface $date;

            protected function getValueCaster(?CustomizableValueCaster $valueCaster = null): CustomizableValueCaster
            {
                $valueCaster = parent::getValueCaster();
                return ValueCasterCache::cache(
                    self::class,
                    function () use ($valueCaster): CustomizableValueCaster {
                        $newValueCaster = new class() extends CustomizableValueCaster {
                            public function cast($value, FieldValidator $validator)
                            {
                                if (is_bool($value)) {
                                    return !$value;
                                }

                                return parent::cast($value, $validator);
                            }
                        };

                        $newValueCaster->setNext($valueCaster);

                        return $newValueCaster;
                    }
                );
            }
        };

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

    public function testSuccessCanCastingInnerDto(array $data) {
        //todo протестировать кастинг вложенных объектов
    }

    public function testSuccessCanCastingInnerList(array $data) {
        //todo протестировать кастинг вложенных списков
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create('ru_RU');
    }
}