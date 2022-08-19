<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredOneOfIfValueIs;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class AlsoRequiredOneOfIfValueIs extends AbstractConstraint
{
    private const MESSAGE = 'Also required one of fields %s when property value is %s.';

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAlsoRequiredOneOfIfValueIs) {
            throw new UnexpectedTypeException($this->option, OptionAlsoRequiredOneOfIfValueIs::class);
        }

        $this->throwIfInputIsNotArrayAndIsNotObject($input);

        $value = $this->getValue($input, $parameter);

        if (
            $value === $this->option->getExpectedValue()
            || $this->toString($value) === $this->toString($this->option->getExpectedValue())
        ) {
            $expectedFieldExists = false;

            foreach ($this->option->getFields() as $field) {
                $valueField = $this->getValue($input, $field);

                if ($valueField !== null) {
                    $expectedFieldExists = true;
                    break;
                }
            }

            if ($expectedFieldExists === false) {
                $this->violations->addViolation(
                    new ConstraintViolation(
                        $this->getMessage(self::MESSAGE, implode(', ', $this->option->getFields()), $value),
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
