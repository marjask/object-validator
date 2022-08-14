<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use ArgumentCountError;
use Marjask\ObjectValidator\Constraints\Option\AbstractOption;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\ObjectValidator;
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

    /**
     * @throws ReflectionException
     */
    protected function getValueProperty(ObjectValidator $object, string $property): mixed
    {
        $reflectionProperty = new ReflectionProperty($object, $property);

        if ($reflectionProperty->isInitialized($object)) {
            return $reflectionProperty->getValue($object);
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
}
