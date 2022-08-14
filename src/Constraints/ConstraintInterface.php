<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\ObjectValidator;
use Marjask\ObjectValidator\ConstraintViolationList;

interface ConstraintInterface
{
    public function validate(ObjectValidator $object, string $property): ConstraintViolationList;
}
