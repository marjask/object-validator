<?php

declare(strict_types=1);

namespace ObjectValidator\Tests;

use Marjask\ObjectValidator\Constraints\ConstraintInterface;
use Marjask\ObjectValidator\ConstraintViolationList;

class MockConstraintViolation implements ConstraintInterface
{
    public function validate(mixed $input, string $parameter): ConstraintViolationList
    {
        return new ConstraintViolationList();
    }
}
