<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class AlsoRequired extends AbstractConstraint
{
    private const MESSAGE = 'Property %s is also required with property %s.';

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAlsoRequired) {
            throw new UnexpectedTypeException($this->option, OptionAlsoRequired::class);
        }

        $this->throwIfInputIsNotArrayAndIsNotObject($input);

        foreach ($this->option->getFields() as $field) {
            $value = $this->getValue($input, $field);

            if ($value === null) {
                $this->violations->addViolation(
                    new ConstraintViolation(
                        $this->getMessage(self::MESSAGE, $field, $parameter),
                        $parameter,
                        $this
                    )
                );
            }
        }

        return $this->violations;
    }
}
