<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests;

use Marjask\ObjectValidator\Constraints\ConstraintInterface;
use Marjask\ObjectValidator\ConstraintViolation;
use PHPUnit\Framework\TestCase;

class ConstraintViolationTest extends TestCase
{
    public function testObject(): void
    {
        $violation = new ConstraintViolation(
            'Phpunit',
            'test',
            new MockConstraintViolation()
        );

        $this->assertEquals('Phpunit', $violation->getMessage());
        $this->assertEquals('test', $violation->getProperty());
        $this->assertInstanceOf(ConstraintInterface::class, $violation->getConstraint());
    }
}
