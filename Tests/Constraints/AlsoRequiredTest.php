<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\Constraints\AlsoRequired;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\ConstraintViolationList;

class AlsoRequiredTest extends AbstractConstraintsTest
{
    public function testSuccessOneField(): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: ['test']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    public function testFailedOneField(): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: ['test']
            )
        );

        $object = $this->getObjectToValidate();

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }

    public function testSuccessTwoFields(): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: ['test', 'beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setTest('123')
            ->setBeta('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertTrue($violations->isEmpty());
    }

    public function testFailedTwoFields(): void
    {
        $constraint = new AlsoRequired(
            new OptionAlsoRequired(
                fields: ['test', 'beta']
            )
        );

        $object = $this->getObjectToValidate()
            ->setBeta('123');

        $violations = $constraint->validate($object, 'main');

        $this->assertInstanceOf(ConstraintViolationList::class, $violations);
        $this->assertFalse($violations->isEmpty());
    }
}
