<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\Length;
use Marjask\ObjectValidator\Constraints\Option\OptionLength;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class LengthTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\LengthDataProvider::dataToSuccess()
     */
    public function testSuccess(?int $min, ?int $max, mixed $input, string $parameter): void
    {
        $constraint = new Length(
            new OptionLength(
                min: $min,
                max: $max
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\DataProvider\LengthDataProvider::dataToFailed()
     */
    public function testFailed(?int $min, ?int $max, mixed $input, string $parameter): void
    {
        $constraint = new Length(
            new OptionLength(
                min: $min,
                max: $max
            )
        );

        $violations = $constraint->validate($input, $parameter);

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
