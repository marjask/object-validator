<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option\DataProvider;

use Generator;

final class OptionAlsoRequiredDataProvider
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
