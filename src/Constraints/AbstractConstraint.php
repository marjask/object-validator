<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use ArgumentCountError;
use InvalidArgumentException;
use Marjask\ObjectValidator\Constraints\Option\AbstractOption;
use Marjask\ObjectValidator\ConstraintViolationList;
use ReflectionException;
use ReflectionProperty;

abstract class AbstractConstraint implements ConstraintInterface
{
    protected ConstraintViolationList $violations;

    public function __construct(
        protected AbstractOption $option
    ) {
        $this->violations = new ConstraintViolationList();
    }

    protected function getValue(mixed $input, string $parameter): mixed
    {
        if (is_object($input)) {
            return $this->getValuePropertyFromObject($input, $parameter);
        }

        if (is_array($input)) {
            return $this->getValueFromArray($input, $parameter);
        }

        if (is_string($input) || is_numeric($input) || is_bool($input)) {
            return $input;
        }

        return null;
    }

    /**
     * @throws ReflectionException
     */
    protected function getValuePropertyFromObject(mixed $object, string $property): mixed
    {
        $reflectionProperty = new ReflectionProperty($object, $property);

        if ($reflectionProperty->isInitialized($object)) {
            return $reflectionProperty->getValue($object);
        }

        return null;
    }

    protected function getValueFromArray(array $array, string $key): mixed
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        return null;
    }

    protected function getMessage(string $message, mixed ... $parameters): string
    {
        if (is_string($this->option->getCustomMessage())) {
            try {
                return sprintf($this->option->getCustomMessage(), ...$this->option->getMessageParameters());
            } catch (ArgumentCountError $e) {
                // do nothing, return default message.
            }
        }

        return sprintf($message, ...$parameters);
    }

    protected function throwIfInputIsNotArrayAndIsNotObject(mixed $input): void
    {
        if (!is_array($input) && !is_object($input)) {
            throw new InvalidArgumentException(
                sprintf('%s allow validate only arrays and objects.', self::class)
            );
        }
    }
}
