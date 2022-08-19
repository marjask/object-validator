<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionType;
use Marjask\ObjectValidator\Constraints\Type;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\TypeDataProvider::dataToSuccess()
     */
    public function testSuccess(string $type, mixed $input, string $parameter): void
    {
        $constraint = new Type(
            new OptionType($type)
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\TypeDataProvider::dataToFailed()
     */
    public function testObjectValidateFailedLength(string $type, mixed $input, string $parameter): void
    {
        $constraint = new Type(
            new OptionType($type)
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
