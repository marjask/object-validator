<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator;

use Marjask\ObjectValidator\Constraints\AbstractConstraint;
use Marjask\ObjectValidator\Constraints\ConstraintInterface;
use Marjask\ObjectValidator\Exception\InvalidValidationException;

abstract class AbstractValidator
{
    protected ConstraintsCollection $constraintCollection;
    protected ConstraintViolationList $violations;

    abstract public function loadConstraints(): void;

    final public function __construct()
    {
        $this->constraintCollection = new ConstraintsCollection();
        $this->violations = new ConstraintViolationList();
    }

    public static function create(): static
    {
        $instance = new static();
        $instance->loadConstraints();

        return $instance;
    }

    final public function addConstraint(string $parameter, AbstractConstraint ...$constraint): self
    {
        $this->constraintCollection->addConstraint($parameter, ...$constraint);

        return $this;
    }

    final public function validate(mixed $input): ConstraintViolationList
    {
        if ($this->violations->isNotEmpty()) {
            return $this->violations;
        }

        /** @var ConstraintInterface $constraint */
        foreach ($this->constraintCollection->getConstraints() as $parameter => $arrayConstraints) {
            foreach ($arrayConstraints as $constraint) {
                $this->violations->addViolations(
                    $constraint->validate($input, $parameter)
                );
            }
        }

        return $this->violations;
    }

    final public function isValid(mixed $input): bool
    {
        return $this->validate($input)->isEmpty();
    }

    final public function isInvalid(mixed $input): bool
    {
        return $this->validate($input)->isNotEmpty();
    }

    final public function getViolations(mixed $input): ConstraintViolationList
    {
        return $this->validate($input);
    }

    public function throwIfInvalid(mixed $input): void
    {
        $constraintViolationList = $this->validate($input);

        if ($constraintViolationList->isNotEmpty()) {
            throw new InvalidValidationException('Invalid validate fields: ', $constraintViolationList->getMessages());
        }
    }
}
