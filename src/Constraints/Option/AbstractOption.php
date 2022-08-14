<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints\Option;

abstract class AbstractOption
{
    public function __construct(
        private readonly ?string $customMessage = null,
        private readonly ?array $messageParameters = null
    ) {
    }

    public function getCustomMessage(): ?string
    {
        return $this->customMessage;
    }

    public function getMessageParameters(): ?array
    {
        return $this->messageParameters;
    }
}
