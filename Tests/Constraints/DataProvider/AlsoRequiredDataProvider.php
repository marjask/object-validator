<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\DataProvider;

use DateTime;
use Generator;
use ObjectValidator\Tests\Constraints\ObjectGenerator;
use stdClass;

final class AlsoRequiredDataProvider extends ObjectGenerator
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'fields' => ['test'],
            'input' => self::getObjectToValidate()
                ->setTest('123'),
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test', 'beta'],
            'input' => self::getObjectToValidate()
                ->setTest('123')
                ->setBeta('123'),
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test'],
            'input' => ['test' => '123'],
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test', 'beta'],
            'input' => ['test' => '123', 'beta' => 123],
            'parameter' => 'main',
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'fields' => ['test'],
            'input' => self::getObjectToValidate(),
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test', 'beta'],
            'input' => self::getObjectToValidate()
                ->setBeta('123'),
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test'],
            'input' => [],
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test', 'beta'],
            'input' => ['beta' => 123],
            'parameter' => 'main',
        ];
    }

    public static function dataThrowException(): Generator
    {
        yield [
            'fields' => ['test', 'beta'],
            'input' => 123,
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test', 'beta'],
            'input' => true,
            'parameter' => 'main',
        ];
        yield [
            'fields' => ['test', 'beta'],
            'input' => null,
            'parameter' => 'main',
        ];
    }
}
