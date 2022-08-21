<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use InvalidArgumentException;
use Marjask\ObjectValidator\Constraints\AlsoRequired;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class AlsoRequiredTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredDataProvider::dataToSuccess()
     */
    public function testSuccess(array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: $fields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredDataProvider::dataToFailed()
     */
    public function testObjectValidateFailedOneField(array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: $fields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AlsoRequiredDataProvider::dataThrowException()
     */
    public function testBasicTypesValidateSuccessTwoFields(array $fields, mixed $input, string $parameter): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: $fields
            )
        );

        $this->expectException(InvalidArgumentException::class);
        $constraint->validate($input, $parameter);
    }
}
