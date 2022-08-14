<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests;

use Marjask\ObjectValidator\ConstraintViolation;
use Marjask\ObjectValidator\ConstraintViolationList;
use PHPUnit\Framework\TestCase;

final class ConstraintViolationListTest extends TestCase
{
    public function testPush(): void
    {
        $list = new ConstraintViolationList();

        $this->assertTrue($list->isEmpty());

        $list->addViolation(
            new ConstraintViolation(
                'Phpunit',
                'test',
                new MockConstraintViolation()
            )
        );

        $this->assertTrue($list->isNotEmpty());

        $secondList = (new ConstraintViolationList())
            ->addViolations($list);

        $this->assertTrue($secondList->isNotEmpty());
        $this->assertNotEmpty($secondList->getElements());
        $this->assertIsArray($secondList->getMessages());
        foreach ($secondList->getMessages() as $message) {
            $this->assertEquals('Phpunit', $message);
        }
    }
}
