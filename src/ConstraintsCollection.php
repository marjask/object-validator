<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator;

use Marjask\ObjectValidator\Constraints\ConstraintInterface;

class ConstraintsCollection
{
    private array $collection = [];

    final public function addConstraint(string $property, ConstraintInterface ... $constraints): self
    {
        foreach ($constraints as $constraint) {
            $this->collection[$property][] = $constraint;
        }

        return $this;
    }

    final public function getConstraints(): array
    {
        return $this->collection;
    }

    public function flush(): void
    {
        $this->collection = [];
    }
}
