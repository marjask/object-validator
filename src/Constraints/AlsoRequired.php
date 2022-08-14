<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;
use Marjask\ObjectValidator\ObjectValidator;

class AlsoRequired extends AbstractConstraint
{
    private const MESSAGE = 'Property %s is also required with property %s.';

    public function validate(ObjectValidator $object, string $property): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAlsoRequired) {
            throw new UnexpectedTypeException($this->option, OptionAlsoRequired::class);
        }

        foreach ($this->option->getFields() as $field) {
            $value = $this->getValueProperty($object, $field);

            if ($value === null) {
                $this->violations->addViolation(
                    new ConstraintViolation(
                        $this->getMessage(self::MESSAGE, $field, $property),
                        $property,
                        $this
                    )
                );
            }
        }

        return $this->violations;
    }
}
