<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator;

use Marjask\ObjectValidator\Constraints\ConstraintInterface;

class ConstraintViolation
{
    public function __construct(
        private readonly string $message,
        private readonly string $property,
        private readonly ConstraintInterface $constraint
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getConstraint(): ConstraintInterface
    {
        return $this->constraint;
    }
}
