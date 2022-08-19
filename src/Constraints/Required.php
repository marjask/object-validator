<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionRequired;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class Required extends AbstractConstraint
{
    private const MESSAGE = 'Property %s required.';

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionRequired) {
            throw new UnexpectedTypeException($this->option, OptionRequired::class);
        }

        $value = $this->getValue($input, $parameter);

        if ($value !== null) {
            return $this->violations;
        }

        $this->violations->addViolation(
            new ConstraintViolation(
                $this->getMessage(self::MESSAGE, $parameter),
                $parameter,
                $this
            )
        );

        return $this->violations;
    }
}
