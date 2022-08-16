<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionType;
use Marjask\ObjectValidator\Constraints\Type;
use Marjask\ObjectValidator\ConstraintViolationList;

class TypeTest extends AbstractConstraintsTest
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\TypeDataProvider::dataToSuccess()
     */
    public function testSuccessType(string $type, mixed $value): void
    {
        $constraint = new Type(
            new OptionType($type)
        );

        $object = $this->getObjectToValidate()
            ->setMain($value);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\TypeDataProvider::dataToFailed()
     */
    public function testFailedLength(string $type, mixed $value): void
    {
        $constraint = new Type(
            new OptionType($type)
        );

        $object = $this->getObjectToValidate()
            ->setMain($value);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
