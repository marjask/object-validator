<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\DataProvider;

use DateTime;
use Generator;
use ObjectValidator\Tests\Constraints\ObjectGenerator;
use stdClass;

final class TypeOrNullDataProvider extends ObjectGenerator
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'type' => 'string',
            'input' => self::getObjectToValidate()
                ->setMain('12345'),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'string',
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => self::getObjectToValidate()
                ->setMain('12345'),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => self::getObjectToValidate()
                ->setMain(12345),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => self::getObjectToValidate()
                ->setMain(true),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];
        yield [
            'type' => DateTime::class,
            'input' => self::getObjectToValidate()
                ->setMain(new DateTime()),
            'parameter' => 'main',
        ];
        yield [
            'type' => DateTime::class,
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];
        yield [
            'type' => stdClass::class,
            'input' => self::getObjectToValidate()
                ->setMain((object) ['phpunit' => 1]),
            'parameter' => 'main',
        ];
        yield [
            'type' => stdClass::class,
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];

        yield [
            'type' => 'string',
            'input' => ['main' => '12345'],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'string',
            'input' => ['main' => null],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => ['main' => '12345'],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => ['main' => null],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => ['main' => null],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => ['main' => null],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => ['main' => true],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => ['main' => null],
            'parameter' => 'main',
        ];
        yield [
            'type' => DateTime::class,
            'input' => ['main' => new DateTime()],
            'parameter' => 'main',
        ];
        yield [
            'type' => DateTime::class,
            'input' => ['main' => null],
            'parameter' => 'main',
        ];
        yield [
            'type' => stdClass::class,
            'input' => ['main' => (object) ['phpunit' => 1]],
            'parameter' => 'main',
        ];
        yield [
            'type' => stdClass::class,
            'input' => ['main' => null],
            'parameter' => 'main',
        ];

        yield [
            'type' => 'string',
            'input' => '12345',
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => '12345',
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => 123,
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => true,
            'parameter' => 'main',
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'type' => 'string',
            'input' => self::getObjectToValidate()
                ->setMain(12345),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => self::getObjectToValidate()
                ->setMain('abc'),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => self::getObjectToValidate()
                ->setMain('abc'),
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => self::getObjectToValidate()
                ->setMain('true'),
            'parameter' => 'main',
        ];
        yield [
            'type' => DateTime::class,
            'input' => self::getObjectToValidate()
                ->setMain((object) ['phpunit' => 1]),
            'parameter' => 'main',
        ];
        yield [
            'type' => stdClass::class,
            'input' => self::getObjectToValidate()
                ->setMain(new DateTime()),
            'parameter' => 'main',
        ];

        yield [
            'type' => 'string',
            'input' => ['main' => 12345],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => ['main' => 'abc'],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => ['main' => 'abc'],
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => ['main' => 'true'],
            'parameter' => 'main',
        ];
        yield [
            'type' => DateTime::class,
            'input' => ['main' => (object) ['phpunit' => 1]],
            'parameter' => 'main',
        ];
        yield [
            'type' => stdClass::class,
            'input' => ['main' => new DateTime()],
            'parameter' => 'main',
        ];

        yield [
            'type' => 'string',
            'input' => 12,
            'parameter' => 'main',
        ];
        yield [
            'type' => 'numeric',
            'input' => 'ad',
            'parameter' => 'main',
        ];
        yield [
            'type' => 'int',
            'input' => '1q',
            'parameter' => 'main',
        ];
        yield [
            'type' => 'bool',
            'input' => 'as',
            'parameter' => 'main',
        ];
    }
}
