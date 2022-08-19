<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option\DataProvider;

use DateTime;
use Generator;

final class OptionTypeDataProvider
{
    public static function data(): Generator
    {
        yield [
            'type' => 'string',
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'type' => 'int',
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'type' => DateTime::class,
            'customMessage' => null,
            'messageParameters' => null,
        ];
        yield [
            'type' => 'string',
            'customMessage' => 'Property %s must be %s',
            'messageParameters' => ['phpunit', 'string'],
        ];
    }
}
