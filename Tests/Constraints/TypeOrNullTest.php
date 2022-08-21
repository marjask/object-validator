<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionTypeOrNull;
use Marjask\ObjectValidator\Constraints\TypeOrNull;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class TypeOrNullTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\TypeOrNullDataProvider::dataToSuccess()
     */
    public function testSuccess(string $type, mixed $input, string $parameter): void
    {
        $constraint = new TypeOrNull(
            new OptionTypeOrNull($type)
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\TypeOrNullDataProvider::dataToFailed()
     */
    public function testFailed(string $type, mixed $input, string $parameter): void
    {
        $constraint = new TypeOrNull(
            new OptionTypeOrNull($type)
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
