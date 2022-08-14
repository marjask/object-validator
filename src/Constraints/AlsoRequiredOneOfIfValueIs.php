<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredOneOfIfValueIs;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;
use Marjask\ObjectValidator\ObjectValidator;

class AlsoRequiredOneOfIfValueIs extends AbstractConstraint
{
    private const MESSAGE = 'Also required one of fields %s when property value is %s.';

    public function validate(ObjectValidator $object, string $property): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAlsoRequiredOneOfIfValueIs) {
            throw new UnexpectedTypeException($this->option, OptionAlsoRequiredOneOfIfValueIs::class);
        }

        $valueProperty = $this->getValueProperty($object, $property);

        if (
            $valueProperty === $this->option->getExpectedValue()
            || $this->toString($valueProperty) === $this->toString($this->option->getExpectedValue())
        ) {
            $expectedFieldExists = false;

            foreach ($this->option->getFields() as $field) {
                $value = $this->getValueProperty($object, $field);

                if ($value !== null) {
                    $expectedFieldExists = true;
                    break;
                }
            }

            if ($expectedFieldExists === false) {
                $this->violations->addViolation(
                    new ConstraintViolation(
                        $this->getMessage(self::MESSAGE, implode(', ', $this->option->getFields()), $valueProperty),
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
