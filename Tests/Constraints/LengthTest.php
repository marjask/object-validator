<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\Length;
use Marjask\ObjectValidator\Constraints\Option\OptionLength;
use Marjask\ObjectValidator\ConstraintViolationList;

class LengthTest extends AbstractConstraintsTest
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\LengthDataProvider::dataToSuccess()
     */
    public function testSuccessLength(?int $min, ?int $max, ?string $value): void
    {
        $constraint = new Length(
            new OptionLength(
                min: $min,
                max: $max
            )
        );

        $object = $this->getObjectToValidate()
            ->setMain($value);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\LengthDataProvider::dataToFailed()
     */
    public function testFailedLength(?int $min, ?int $max, ?string $value): void
    {
        $constraint = new Length(
            new OptionLength(
                min: $min,
                max: $max
            )
        );

        $object = $this->getObjectToValidate()
            ->setMain($value);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
