<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Exception;

use InvalidArgumentException;

final class InvalidValidationException extends InvalidArgumentException
{
    public function __construct(string $message = "Invalid validation fields: ", array $fields = [])
    {
        parent::__construct($message . implode(', ', $fields));
    }
}
