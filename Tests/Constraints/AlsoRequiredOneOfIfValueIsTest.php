<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use InvalidArgumentException;
use Marjask\ObjectValidator\Constraints\AlsoRequiredOneOfIfValueIs;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredOneOfIfValueIs;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class AlsoRequiredOneOfIfValueIsTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredOneOfIfValueIsDataProvider::dataToSuccess()
     */
    public function testSuccess(mixed $expectedValue, array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
                expectedValue: $expectedValue,
                fields: $fields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredOneOfIfValueIsDataProvider::dataToFailed()
     */
    public function testFailed(mixed $expectedValue, array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
                expectedValue: $expectedValue,
                fields: $fields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredOneOfIfValueIsDataProvider::dataThrowException()
     */
    public function testBasicTypeValidateSuccessTwoField(mixed $expectedValue, array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
                expectedValue: $expectedValue,
                fields: $fields
            )
        );

        $this->expectException(InvalidArgumentException::class);
        $constraint->validate($input, $parameter);
    }
}
