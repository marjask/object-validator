<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use PHPUnit\Framework\TestCase;

class OptionAlsoRequiredTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\Option\DataProvider\OptionAlsoRequiredDataProvider::data()
     */
    public function testCreate(array $fields, ?string $customMessage, ?array $messageParameters): void
    {
        $constraint = new OptionAlsoRequired(
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
