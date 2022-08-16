<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionLength;
use PHPUnit\Framework\TestCase;

class OptionLengthTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\Option\OptionLengthDataProvider::data()
     */
    public function testCreate(?int $min, ?int $max, ?string $customMessage, ?array $messageParameters): void
    {
        $constraint = new OptionLength(
            min: $min,
            max: $max,
            customMessage: $customMessage,
            messageParameters: $messageParameters,
        );

        $this->assertEquals($min, $constraint->getMin());
        $this->assertEquals($max, $constraint->getMax());
        $this->assertEquals($customMessage, $constraint->getCustomMessage());
        $this->assertEquals($messageParameters, $constraint->getMessageParameters());
    }
}
