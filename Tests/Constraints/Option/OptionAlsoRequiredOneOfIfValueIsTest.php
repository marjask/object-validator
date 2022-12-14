<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredOneOfIfValueIs;
use PHPUnit\Framework\TestCase;

class OptionAlsoRequiredOneOfIfValueIsTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\Option\DataProvider\OptionAlsoRequiredOneOfIfValueIsDataProvider::data()
     */
    public function testCreate(
        mixed $expectedValue,
        array $fields,
        ?string $customMessage,
        ?array $messageParameters
    ): void {
        $constraint = new OptionAlsoRequiredOneOfIfValueIs(
            expectedValue: $expectedValue,
            fields: $fields,
            customMessage: $customMessage,
            messageParameters: $messageParameters,
        );

        $this->assertIsArray($constraint->getFields());
        $this->assertEquals($fields, $constraint->getFields());
        $this->assertEquals($customMessage, $constraint->getCustomMessage());
        $this->assertEquals($messageParameters, $constraint->getMessageParameters());
    }
}
