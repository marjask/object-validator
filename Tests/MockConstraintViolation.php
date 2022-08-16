<?php

declare(strict_types=1);

namespace ObjectValidator\Tests;

use Marjask\ObjectValidator\Constraints\ConstraintInterface;
use Marjask\ObjectValidator\ConstraintViolationList;
use Marjask\ObjectValidator\ObjectValidator;

class MockConstraintViolation implements ConstraintInterface
{
    public function validate(ObjectValidator $object, string $property): ConstraintViolationList
    {
        return new ConstraintViolationList();
    }
}
