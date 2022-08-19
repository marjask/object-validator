<?php

declare(strict_types=1);

namespace ObjectValidator\Tests;

use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testValidator(): void
    {
        $input = 'phpunit';
        $validator = MockValidator::create();
        $this->assertInstanceOf(MockValidator::class, $validator);
        $this->assertInstanceOf(ConstraintViolationList::class, $validator->getViolations($input));
        $this->assertInstanceOf(ConstraintViolationList::class, $validator->validate($input));
        $this->assertTrue($validator->isValid($input));
    }
}
