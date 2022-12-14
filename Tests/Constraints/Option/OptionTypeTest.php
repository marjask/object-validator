<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionType;
use PHPUnit\Framework\TestCase;

class OptionTypeTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\Option\DataProvider\OptionTypeDataProvider::data()
     */
    public function testCreate(string $type, ?string $customMessage, ?array $messageParameters): void
    {
        $constraint = new OptionType(
            type: $type,
            customMessage: $customMessage,
            messageParameters: $messageParameters,
        );

        $this->assertEquals($type, $constraint->getType());
        $this->assertEquals($customMessage, $constraint->getCustomMessage());
        $this->assertEquals($messageParameters, $constraint->getMessageParameters());
    }
}
