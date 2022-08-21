<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\DataProvider;

use Generator;
use ObjectValidator\Tests\Constraints\ObjectGenerator;

final class AtLeastDataProvider extends ObjectGenerator
{
    public static function dataToSuccess(): Generator
    {
        yield [
            'requiredFields' => ['test'],
            'input' => self::getObjectToValidate()
                ->setMain('test')
                ->setTest('123'),
            'checkParameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test', 'beta'],
            'input' => self::getObjectToValidate()
                ->setBeta('123'),
            'parameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test'],
            'input' => ['main' => 'test', 'test' => '123'],
            'checkParameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test', 'beta'],
            'input' => ['beta' => '123'],
            'parameter' => 'main',
        ];
    }

    public static function dataToFailed(): Generator
    {
        yield [
            'requiredFields' => ['test'],
            'input' => self::getObjectToValidate()
                ->setBeta('123'),
            'checkParameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test', 'beta'],
            'input' => self::getObjectToValidate()
                ->setGamma('123'),
            'parameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test'],
            'input' => ['beta' => '123'],
            'checkParameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test', 'beta'],
            'input' => ['gamma' => '123'],
            'parameter' => 'main',
        ];
    }

    public static function dataThrowException(): Generator
    {
        yield [
            'requiredFields' => ['test'],
            'input' => 123,
            'checkParameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test'],
            'input' => null,
            'checkParameter' => 'main',
        ];
        yield [
            'requiredFields' => ['test'],
            'input' => false,
            'checkParameter' => 'main',
        ];
    }
}
