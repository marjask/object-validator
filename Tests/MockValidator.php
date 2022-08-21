<?php

declare(strict_types=1);

namespace ObjectValidator\Tests;

use Marjask\ObjectValidator\AbstractValidator;

final class MockValidator extends AbstractValidator
{
    public function loadConstraints(): void
    {
    }
}
