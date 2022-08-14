<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Constraints\Option;

class OptionLength extends AbstractOption
{
    public function __construct(
        private readonly ?int $min,
        private readonly ?int $max,
        ?string $customMessage = null,
        ?array $messageParameters = null
    ) {
        parent::__construct($customMessage, $messageParameters);
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }
}
