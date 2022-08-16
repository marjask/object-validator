<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\AlsoRequiredIfValueIs;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredIfValueIs;
use Marjask\ObjectValidator\ConstraintViolationList;

class AlsoRequiredIfValueIsTest extends AbstractConstraintsTest
{
    public function testSuccessOneField(): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: '123',
                fields: ['test']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('pop')
            ->setMain('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    public function testFailedOneField(): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: '123',
                fields: ['test']
            )
        );

        $object = $this->getObjectToValidate()
            ->setMain('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    public function testSuccessTwoField(): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: '123',
                fields: ['test', 'beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('pop')
            ->setMain('123')
            ->setBeta(1);

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    public function testFailedTwoField(): void
    {
        $constraint = new AlsoRequiredIfValueIs(
            new OptionAlsoRequiredIfValueIs(
                expectedValue: '123',
                fields: ['test', 'beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setMain('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
