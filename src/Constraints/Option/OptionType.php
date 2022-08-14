<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints\Option;

class OptionType extends AbstractOption
{
    public function __construct(
        private readonly string $type,
        ?string $customMessage = null,
        ?array $messageParameters = null
    ) {
        parent::__construct($customMessage, $messageParameters);
    }

    public function getType(): string
    {
        return $this->type;
    }
}
