<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\AlsoRequiredOneOfIfValueIs;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredOneOfIfValueIs;
use Marjask\ObjectValidator\ConstraintViolationList;

class AlsoRequiredOneOfIfValueIsTest extends AbstractConstraintsTest
{
    public function testSuccessOneField(): void
    {
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
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
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
                expectedValue: '123',
                fields: ['beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('pop')
            ->setMain('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    public function testSuccessTwoField(): void
    {
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
                expectedValue: '123',
                fields: ['test', 'beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('pop')
            ->setMain('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    public function testFailedTwoField(): void
    {
        $constraint = new AlsoRequiredOneOfIfValueIs(
            new OptionAlsoRequiredOneOfIfValueIs(
                expectedValue: '123',
                fields: ['gamma', 'beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('pop')
            ->setMain('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
