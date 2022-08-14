<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints\Option;

class OptionAlsoRequired extends AbstractOption
{
    public function __construct(
        private readonly array $fields,
        ?string $customMessage = null,
        ?array $messageParameters = null
    ) {
        parent::__construct($customMessage, $messageParameters);
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
