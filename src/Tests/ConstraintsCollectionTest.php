<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests;

use Marjask\ObjectValidator\ConstraintsCollection;
use PHPUnit\Framework\TestCase;

class ConstraintsCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        $collection = new ConstraintsCollection();
        $collection->addConstraint(
            'phpunit',
            new MockConstraintViolation()
        );

        $this->assertNotEmpty($collection->getConstraints());

        $constraint = $collection->getConstraints()['phpunit'][0];
        $this->assertInstanceOf(MockConstraintViolation::class, $constraint);

        $collection->flush();
        $this->assertEmpty($collection->getConstraints());
    }
}
