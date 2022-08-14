<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredIfValueIs;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequiredOneOfIfValueIs;
use PHPUnit\Framework\TestCase;

class AlsoRequiredOneOfIfValueIsTest extends TestCase
{
    /**
     * @dataProvider \Marjask\ObjectValidator\Tests\Constraints\Option\AlsoRequiredOneOfIfValueIsDataProvider::data()
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
