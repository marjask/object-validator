<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests\Constraints\Option;

use Generator;

final class OptionLengthDataProvider
{
    public static function data(): Generator
    {
        yield [
            'min' => 2,
            'max' => 4,
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'min' => null,
            'max' => 4,
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'min' => 7,
            'max' => null,
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'min' => 7,
            'max' => 15,
            'customMessage' => 'Length %s must be between %s and %s.',
            'messageParameters' => ['phpunit', 10, 20],
        ];
    }
}
