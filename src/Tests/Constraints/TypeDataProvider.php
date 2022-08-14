<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests\Constraints;

use DateTime;
use Generator;
use stdClass;

final class TypeDataProvider
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'type' => 'string',
            'value' => '12345',
        ];
        yield [
            'type' => 'numeric',
            'value' => '12345',
        ];
        yield [
            'type' => 'int',
            'value' => 12345,
        ];
        yield [
            'type' => 'bool',
            'value' => true,
        ];
        yield [
            'type' => DateTime::class,
            'value' => new DateTime(),
        ];
        yield [
            'type' => stdClass::class,
            'value' => (object) ['phpunit' => 1],
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'type' => 'string',
            'value' => 12345,
        ];
        yield [
            'type' => 'numeric',
            'value' => 'abc',
        ];
        yield [
            'type' => 'int',
            'value' => 'abc',
        ];
        yield [
            'type' => 'bool',
            'value' => 'true',
        ];
        yield [
            'type' => DateTime::class,
            'value' => (object) ['phpunit' => 1],
        ];
        yield [
            'type' => stdClass::class,
            'value' => new DateTime(),
        ];
    }
}
