<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionTypeOrNull;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class TypeOrNull extends Type
{
    private const MESSAGE = 'Property %s must be instanceof %s or be null.';

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionTypeOrNull) {
            throw new UnexpectedTypeException($this->option, OptionTypeOrNull::class);
        }

        $value = $this->getValue($input, $parameter);

        if ($value === null) {
            return $this->violations;
        }

        $expectedType = $this->option->getType();

        if ($this->isValidTypeByNativeFunctions($expectedType, $value)) {
            return $this->violations;
        }

        if (!$value instanceof $expectedType) {
            $this->violations->addViolation(
                new ConstraintViolation(
                    $this->getMessage(self::MESSAGE, $parameter, $expectedType),
                    $parameter,
                    $this
                )
            );
        }

        return $this->violations;
    }
}
