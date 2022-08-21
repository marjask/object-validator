<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use InvalidArgumentException;
use Marjask\ObjectValidator\Constraints\AlsoRequiredIfValueIs;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredIfValueIs;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class AlsoRequiredIfValueIsTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredIfValueIsDataProvider::dataToSuccess()
     */
    public function testSuccess(mixed $expectedValue, array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: $expectedValue,
                fields: $fields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredIfValueIsDataProvider::dataToFailed()
     */
    public function testFailed(mixed $expectedValue, array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: $expectedValue,
                fields: $fields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredIfValueIsDataProvider::dataThrowException()
     */
    public function testBasicTypeValidateFailed(mixed $expectedValue, array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: $expectedValue,
                fields: $fields
            )
        );

        $this->expectException(InvalidArgumentException::class);
        $constraint->validate($input, $parameter);
    }
}
