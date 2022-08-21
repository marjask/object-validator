<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option\DataProvider;

use Generator;

final class OptionAlsoRequiredIfValueIsDataProvider
{
    public static function data(): Generator
    {
        yield [
            'expectedValue' => '123',
            'fields' => ['phpunit'],
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'expectedValue' => '123',
            'fields' => ['phpunit'],
            'customMessage' => 'Also required %s when value is %s.',
            'messageParameters' => ['phpunit', '234'],
        ];
    }
}
