<?php

declare(strict_types=1);

namespace Mafin\DTO\Tests\Unit;

use DateTimeInterface;
use Mafin\DTO\Casters\CustomizableValueCaster;
use Mafin\DTO\Tests\Unit\Classes\TestDto;
use Mafin\DTO\Tests\Unit\Classes\TestEnumDto;
use Mafin\DTO\Tests\Unit\Classes\TestInnerCollectionCasterDtoList;
use Mafin\DTO\Tests\Unit\Classes\TestInnerDto;
use Mafin\DTO\Tests\Unit\Classes\TestInnerDtoList;
use Mafin\DTO\Tests\Unit\Classes\TestInnerListBaseTypeDto;
use Mafin\DTO\Tests\Unit\Classes\TestUuidDto;
use Mafin\DTO\Tests\Unit\Classes\TestValueCasterDto;
use MyCLabs\Enum\Enum;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class CustomizableDataTransferObjectTest extends TestCase
{
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
        return [
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime()),
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => rand(),
                    'date' => (new \DateTime())
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime())->format('d.m.Y')
                ]
            ],
            [
                [
                    'bool' => 1,
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime())
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
        return [
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime())
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => rand(),
                    'date' => (new \DateTime())
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime())->format('d.m.Y')
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
        return [
            [
                [
                    'bool' => null,
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime())->format('Y-m-d\TH:i:sP')
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => null,
                    'float' => (float) (rand() / 100),
                    'date' => (new \DateTime())->format('Y-m-d\TH:i:sP')
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => null,
                    'date' => (new \DateTime())->format('Y-m-d\TH:i:sP')
                ]
            ],
            [
                [
                    'bool' => (bool) rand(0, 1),
                    'int' => rand(),
                    'float' => (float) (rand() / 100),
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

    /**
     * @dataProvider validBooleanCastInCollectionProvider
     */
    public function testSuccessCanCastingCollectionValue(array $data)
    {
        $dto = new TestInnerCollectionCasterDtoList(['var' => [$data]]);

        self::assertEquals(!$data[0], $dto->var->current());
    }

    public function validBooleanCastInCollectionProvider(): array
    {
        return [
            [
                [true]
            ],
            [
                [false]
            ]
        ];
    }

    public function testSuccesCanCreateBaseTypeList()
    {
        $data = range('a', 'z');

        $dto = new TestInnerListBaseTypeDto(['var' => $data]);

        self::assertEquals($data, $dto->var->toArray());
        self::assertIsString($dto->var->current());
    }

    public function testSuccessCanCreateEnumDto()
    {
        $data = [
            'test' => 'test'
        ];
        $dto = new TestEnumDto($data);

        self::assertInstanceOf(Enum::class, $dto->test);
        self::assertEquals($data['test'], $dto->test->getValue());
    }

    public function testSuccessCanCreateUuidDto()
    {
        $data = [
            'test' => '00000000-0000-0000-0000-000000000000'
        ];
        $dto = new TestUuidDto($data);

        self::assertInstanceOf(UuidInterface::class, $dto->test);
        self::assertEquals($data['test'], $dto->test->toString());
    }

    /** @dataProvider castingStringToIntProvider */
    public function testSuccessCanCastingStringToInt($data) {
        $dto = new TestDto($data);

        self::assertIsInt($dto->int);
    }

    public function castingStringToIntProvider(): array {
        return [
            [
                ['int' => rand()]
            ],
            [
                ['int' => (string) rand()]
            ]
        ];
    }
}