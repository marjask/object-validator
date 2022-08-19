<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints;

use Marjask\ObjectValidator\ConstraintViolationList;

interface ConstraintInterface
{
    public function validate(mixed $input, string $parameter): ConstraintViolationList;
}
