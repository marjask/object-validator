<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionTypeOrNull;
use Marjask\ObjectValidator\Constraints\TypeOrNull;
use Marjask\ObjectValidator\ConstraintViolationList;

class TypeOrNullTest extends AbstractConstraintsTest
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\TypeOrNullDataProvider::dataToSuccess()
     */
    public function testSuccessType(string $type, mixed $value): void
    {
        $constraint = new TypeOrNull(
            new OptionTypeOrNull($type)
        );

        $object = $this->getObjectToValidate()
            ->setMain($value);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\TypeOrNullDataProvider::dataToFailed()
     */
    public function testFailedLength(string $type, mixed $value): void
    {
        $constraint = new TypeOrNull(
            new OptionTypeOrNull($type)
        );

        $object = $this->getObjectToValidate()
            ->setMain($value);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
