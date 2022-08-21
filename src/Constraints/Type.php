<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\Constraints\Option\OptionType;
use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\Exception\UnexpectedTypeException;

class Type extends AbstractConstraint
{
    private const MESSAGE = 'Property %s must be type %s.';

    protected const VALIDATION_FUNCTIONS = [
        'bool' => 'is_bool',
        'boolean' => 'is_bool',
        'int' => 'is_int',
        'integer' => 'is_int',
        'long' => 'is_int',
        'float' => 'is_float',
        'double' => 'is_float',
        'real' => 'is_float',
        'numeric' => 'is_numeric',
        'string' => 'is_string',
        'scalar' => 'is_scalar',
        'array' => 'is_array',
        'iterable' => 'is_iterable',
        'countable' => 'is_countable',
        'callable' => 'is_callable',
        'object' => 'is_object',
        'resource' => 'is_resource',
        'null' => 'is_null',
        'alnum' => 'ctype_alnum',
        'alpha' => 'ctype_alpha',
        'cntrl' => 'ctype_cntrl',
        'digit' => 'ctype_digit',
        'graph' => 'ctype_graph',
        'lower' => 'ctype_lower',
        'print' => 'ctype_print',
        'punct' => 'ctype_punct',
        'space' => 'ctype_space',
        'upper' => 'ctype_upper',
        'xdigit' => 'ctype_xdigit',
    ];

    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        if (!$this->option instanceof OptionType) {
            throw new UnexpectedTypeException($this->option, OptionType::class);
        }

        $value = $this->getValue($input, $parameter);
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

    protected function isValidTypeByNativeFunctions(string $type, mixed $value): bool
    {
        $type = strtolower($type);

        return array_key_exists($type, self::VALIDATION_FUNCTIONS)
            && self::VALIDATION_FUNCTIONS[$type]($value);
    }
}
