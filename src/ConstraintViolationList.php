<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator;

class ConstraintViolationList
{
    private array $list = [];

    public function addViolation(ConstraintViolation $violation): self
    {
        $this->list[] = $violation;

        return $this;
    }

    public function addViolations(ConstraintViolationList $violations): self
    {
        /** @var ConstraintViolation $violation */
        foreach ($violations->getElements() as $violation) {
            $this->addViolation($violation);
        }

        return $this;
    }

    public function getMessages(): array
    {
        $messages = [];

        /** @var ConstraintViolation $violation */
        foreach ($this->getElements() as $violation) {
            $messages[] = $violation->getMessage();
        }

        return $messages;
    }

    final public function isEmpty(): bool
    {
        return empty($this->list);
    }

    final public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    final public function getElements(): array
    {
        return $this->list;
    }
}
