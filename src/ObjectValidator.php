<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator;

use Marjask\ObjectValidator\Constraints\AbstractConstraint;
use Marjask\ObjectValidator\Constraints\ConstraintInterface;
use Marjask\ObjectValidator\Exception\InvalidValidationException;

abstract class ObjectValidator
{
    protected ConstraintsCollection $constraintCollection;
    protected ConstraintViolationList $violations;

    abstract protected function loadConstraints(): void;

    public function __construct()
    {
        $this->constraintCollection = new ConstraintsCollection();
    }

    public function addConstraint(string $property, AbstractConstraint $constraint): self
    {
        $this->constraintCollection->addConstraint($property, $constraint);

        return $this;
    }

    final public function validate(): ConstraintViolationList
    {
        $this->loadConstraints();
        $this->violations = new ConstraintViolationList();

        /** @var ConstraintInterface $constraint */
        foreach ($this->constraintCollection->getConstraints() as $property => $arrayConstraints) {
            foreach ($arrayConstraints as $constraint) {
                $this->violations->addViolations(
                    $constraint->validate($this, $property)
                );
            }
        }

        return $this->violations;
    }

    final public function isValid(): bool
    {
        return $this->validate()->isEmpty();
    }

    final public function isInvalid(): bool
    {
        return $this->validate()->isNotEmpty();
    }

    final public function getViolations(): ConstraintViolationList
    {
        if (!isset($this->violations)) {
            $this->validate();
        }

        return $this->violations;
    }

    public function throwIfInvalid(): void
    {
        $violations = $this->validate();
        if ($violations->isNotEmpty()) {
            throw new InvalidValidationException('Invalid validate fields: ', $violations->getMessages());
        }
    }

    public function flushValidators(): self
    {
        $this->constraintCollection->flush();

        return $this;
    }
}
