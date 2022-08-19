<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionTypeOrNull;
use PHPUnit\Framework\TestCase;

class OptionTypeOrNullTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\Option\DataProvider\OptionTypeOrNullDataProvider::data()
     */
    public function testCreate(string $type, ?string $customMessage, ?array $messageParameters): void
    {
        $constraint = new OptionTypeOrNull(
            type: $type,
            customMessage: $customMessage,
            messageParameters: $messageParameters,
        );

        $this->assertEquals($type, $constraint->getType());
        $this->assertEquals($customMessage, $constraint->getCustomMessage());
        $this->assertEquals($messageParameters, $constraint->getMessageParameters());
    }
}
