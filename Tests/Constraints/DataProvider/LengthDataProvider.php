<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\DataProvider;

use Generator;
use ObjectValidator\Tests\Constraints\ObjectGenerator;

final class LengthDataProvider extends ObjectGenerator
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'min' => 3,
            'max' => 10,
            'input' => self::getObjectToValidate()
                ->setMain('12345'),
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'input' => self::getObjectToValidate()
                ->setMain('12345'),
            'parameter' => 'main',
        ];
        yield [
            'min' => null,
            'max' => 5,
            'input' => self::getObjectToValidate()
                ->setMain('1234'),
            'parameter' => 'main',
        ];

        yield [
            'min' => 3,
            'max' => 10,
            'input' => ['main' => '12345'],
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'input' => ['main' => '12345'],
            'parameter' => 'main',
        ];
        yield [
            'min' => null,
            'max' => 5,
            'input' => ['main' => '1234'],
            'parameter' => 'main',
        ];

        yield [
            'min' => 3,
            'max' => 10,
            'input' => '12345',
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'input' => '12345',
            'parameter' => 'main',
        ];
        yield [
            'min' => null,
            'max' => 5,
            'input' => '1234',
            'parameter' => 'main',
        ];
        yield [
            'min' => 1,
            'max' => 7,
            'input' => 123,
            'parameter' => 'main',
        ];
        yield [
            'min' => 1,
            'max' => 7,
            'input' => true,
            'parameter' => 'main',
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'min' => 3,
            'max' => 10,
            'input' => self::getObjectToValidate()
                ->setMain('12'),
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => 7,
            'input' => self::getObjectToValidate()
                ->setMain('12345678'),
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'input' => self::getObjectToValidate()
                ->setMain('12'),
            'parameter' => 'main',
        ];
        yield [
            'min' => null,
            'max' => 7,
            'input' => self::getObjectToValidate()
                ->setMain('12345678'),
            'parameter' => 'main',
        ];
        yield [
            'min' => 1,
            'max' => 7,
            'input' => self::getObjectToValidate()
                ->setMain(null),
            'parameter' => 'main',
        ];

        yield [
            'min' => 3,
            'max' => 10,
            'input' => ['main' => '12'],
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => 7,
            'input' => ['main' => '12345678'],
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'input' => ['main' => '12'],
            'parameter' => 'main',
        ];
        yield [
            'min' => null,
            'max' => 7,
            'input' => ['main' => '12345678'],
            'parameter' => 'main',
        ];
        yield [
            'min' => 1,
            'max' => 7,
            'input' => ['main' => null],
            'parameter' => 'main',
        ];

        yield [
            'min' => 3,
            'max' => 10,
            'input' => '12',
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => 7,
            'input' => '12345678',
            'parameter' => 'main',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'input' => '12',
            'parameter' => 'main',
        ];
        yield [
            'min' => null,
            'max' => 7,
            'input' => '12345678',
            'parameter' => 'main',
        ];
        yield [
            'min' => 1,
            'max' => 7,
            'input' => null,
            'parameter' => 'main',
        ];
    }
}
