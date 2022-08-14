<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionLength;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;
use Marjask\ObjectValidator\ObjectValidator;

class Length extends AbstractConstraint
{
    private const MESSAGE = 'Length property %s must be between %d and %d signs.';

    public function validate(ObjectValidator $object, string $property): ConstraintViolationList
    {
        if (!$this->option instanceof OptionLength) {
            throw new UnexpectedTypeException($this->option, OptionLength::class);
        }

        $value = $this->getValueProperty($object, $property);

        if(!is_string($value)) {
            $value = (string) $value;
        }

        $valueLength = mb_strlen($value);
        $min = $this->option->getMin() ?? 0;
        $max = $this->option->getMax() ?? 0;

        if ($valueLength < $min || ($max > 0 && $valueLength > $max)) {
            $this->violations->addViolation(
                new ConstraintViolation(
                    $this->getMessage(self::MESSAGE, $property, $min, $max),
                    $property,
                    $this
                )
            );
        }

        return $this->violations;
    }
}
