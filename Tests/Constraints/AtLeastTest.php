<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use InvalidArgumentException;
use Marjask\ObjectValidator\Constraints\AtLeast;
use Marjask\ObjectValidator\Constraints\Option\OptionAtLeast;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class AtLeastTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AtLeastDataProvider::dataToSuccess()
     */
    public function testSuccess(array $requiredFields, mixed $input, string $parameter): void
    {
        $constraint = new AtLeast(
            new OptionAtLeast(
                fields: $requiredFields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AtLeastDataProvider::dataToFailed()
     */
    public function testFailed(array $requiredFields, mixed $input, string $parameter): void
    {
        $constraint = new AtLeast(
            new OptionAtLeast(
                fields: $requiredFields
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\AtLeastDataProvider::dataThrowException()
     */
    public function testThrowException(array $requiredFields, mixed $input, string $parameter): void
    {
        $constraint = new AtLeast(
            new OptionAtLeast(
                fields: $requiredFields
            )
        );
        $this->expectException(InvalidArgumentException::class);
        $constraint->validate($input, $parameter);
    }
}
