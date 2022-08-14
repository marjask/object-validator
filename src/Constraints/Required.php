<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionRequired;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;
use Marjask\ObjectValidator\ObjectValidator;

class Required extends AbstractConstraint
{
    private const MESSAGE = 'Property %s required.';

    public function validate(ObjectValidator $object, string $property): ConstraintViolationList
    {
        if (!$this->option instanceof OptionRequired) {
            throw new UnexpectedTypeException($this->option, OptionRequired::class);
        }

        $value = $this->getValueProperty($object, $property);

        if ($value !== null) {
            return $this->violations;
        }

        $this->violations->addViolation(
            new ConstraintViolation(
                $this->getMessage(self::MESSAGE, $property),
                $property,
                $this
            )
        );

        return $this->violations;
    }
}
