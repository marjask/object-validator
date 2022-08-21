<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\DataProvider;

use DateTime;
use Generator;
use ObjectValidator\Tests\Constraints\ObjectGenerator;
use stdClass;

final class AlsoRequiredIfValueIsDataProvider extends ObjectGenerator
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'expectedValue' => '123',
            'fields' => ['test'],
            'input' => self::getObjectToValidate()
                ->setTest('pop')
                ->setMain('123'),
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['test', 'beta'],
            'input' => self::getObjectToValidate()
                ->setTest('pop')
                ->setMain('123')
                ->setBeta(1),
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['test'],
            'input' => ['test' => 'pop', 'main' => '123'],
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['test', 'beta'],
            'input' => [
                'test' => 'pop',
                'main' => '123',
                'beta' => 1,
            ],
            'parameter' => 'main',
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'expectedValue' => '123',
            'fields' => ['test'],
            'input' => self::getObjectToValidate()
                ->setMain('123'),
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['test', 'beta'],
            'input' => self::getObjectToValidate()
                ->setMain('123'),
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['test'],
            'input' => ['main' => '123'],
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['test', 'beta'],
            'input' => ['main' => '123'],
            'parameter' => 'main',
        ];
    }

    public static function dataThrowException(): Generator
    {
        yield [
            'expectedValue' => '123',
            'fields' => ['gamma', 'beta'],
            'input' => 123,
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['gamma', 'beta'],
            'input' => true,
            'parameter' => 'main',
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['gamma', 'beta'],
            'input' => null,
            'parameter' => 'main',
        ];
    }
}
