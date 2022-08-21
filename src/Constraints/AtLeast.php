<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionAtLeast;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class AtLeast extends AbstractConstraint
{
    private const MESSAGE = 'Property %s is require at least properties %s.';

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionAtLeast) {
            throw new UnexpectedTypeException($this->option, OptionAtLeast::class);
        }

        $this->throwIfInputIsNotArrayAndIsNotObject($input);

        foreach ($this->option->getFields() as $field) {
            $valueField = $this->getValue($input, $field);

            if ($valueField !== null) {
                return $this->violations;
            }
        }

        return $this->violations->addViolation(
            new ConstraintViolation(
                $this->getMessage(
                    self::MESSAGE,
                    $parameter,
                    implode(', ', $this->option->getFields())
                ),
                $parameter,
                $this
            )
        );
    }
}
