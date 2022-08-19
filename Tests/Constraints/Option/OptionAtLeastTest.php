<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints\Option;

use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\Constraints\Option\OptionAtLeast;
use PHPUnit\Framework\TestCase;

class OptionAtLeastTest extends TestCase
{
    /**
     * @dataProvider \ObjectValidator\Tests\Constraints\Option\DataProvider\OptionAtLeastDataProvider::data()
     */
    public function testCreate(array $fields, ?string $customMessage, ?array $messageParameters): void
    {
        $constraint = new OptionAtLeast(
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
