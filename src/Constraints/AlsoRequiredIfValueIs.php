<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredIfValueIs;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;
use Marjask\ObjectValidator\ObjectValidator;

class AlsoRequiredIfValueIs extends AbstractConstraint
{
    private const MESSAGE = 'Also required fields %s when property value is %s.';

    public function validate(ObjectValidator $object, string $property): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAlsoRequiredIfValueIs) {
            throw new UnexpectedTypeException($this->option, OptionAlsoRequiredIfValueIs::class);
        }

        $valueProperty = $this->getValueProperty($object, $property);

        if (
            $valueProperty === $this->option->getExpectedValue()
            || $this->toString($valueProperty) === $this->toString($this->option->getExpectedValue())
        ) {
            $missingFields = [];

            foreach ($this->option->getFields() as $field) {
                $value = $this->getValueProperty($object, $field);

                if ($value === null) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                $this->violations->addViolation(
                    new ConstraintViolation(
                        $this->getMessage(self::MESSAGE, implode(', ', $missingFields), $valueProperty),
                        $property,
                        $this
                    )
                );
            }
        }

        return $this->violations;
    }

    private function toString(mixed $var): string
    {
        return (string) $var;
    }
}
