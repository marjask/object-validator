<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Generator;

final class AlsoRequiredDataProvider
{
    public static function data(): Generator
    {
        yield [
            'fields' => ['phpunit'],
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'fields' => ['phpunit'],
            'customMessage' => 'Also required %s when %s.',
            'messageParameters' => ['phpunit', 'is test'],
        ];
    }
}
