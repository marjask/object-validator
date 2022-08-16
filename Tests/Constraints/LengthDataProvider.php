<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Generator;

final class LengthDataProvider
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'min' => 3,
            'max' => 10,
            'value' => '12345',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'value' => '12345',
        ];
        yield [
            'min' => null,
            'max' => 5,
            'value' => '1234',
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'min' => 3,
            'max' => 10,
            'value' => '12',
        ];
        yield [
            'min' => 3,
            'max' => 7,
            'value' => '12345678',
        ];
        yield [
            'min' => 3,
            'max' => null,
            'value' => '12',
        ];
        yield [
            'min' => null,
            'max' => 7,
            'value' => '12345678',
        ];
        yield [
            'min' => 1,
            'max' => 7,
            'value' => null,
        ];
    }
}
