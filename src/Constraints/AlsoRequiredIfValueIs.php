<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredIfValueIs;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class AlsoRequiredIfValueIs extends AbstractConstraint
{
    private const MESSAGE = 'Also required fields %s when property value is %s.';

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAlsoRequiredIfValueIs) {
            throw new UnexpectedTypeException($this->option, OptionAlsoRequiredIfValueIs::class);
        }

        $this->throwIfInputIsNotArrayAndIsNotObject($input);

        $value = $this->getValue($input, $parameter);

        if (
            $value === $this->option->getExpectedValue()
            || $this->toString($value) === $this->toString($this->option->getExpectedValue())
        ) {
            $missingFields = [];

            foreach ($this->option->getFields() as $field) {
                $valueField = $this->getValue($input, $field);

                if ($valueField === null) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                $this->violations->addViolation(
                    new ConstraintViolation(
                        $this->getMessage(self::MESSAGE, implode(', ', $missingFields), $value),
                        $parameter,
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
