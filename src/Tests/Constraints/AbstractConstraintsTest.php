<?php

declare(strict_types=1);

namespace Marjask\ObjectValidator\Tests\Constraints;

use Marjask\ObjectValidator\ObjectValidator;
use PHPUnit\Framework\TestCase;

abstract class AbstractConstraintsTest extends TestCase
{
    protected function getObjectToValidate(): ObjectValidator
    {
        return new class extends ObjectValidator {

            private mixed $test;
            private mixed $main;
            private mixed $gamma;
            private mixed $beta;

            protected function loadConstraints(): void
            {
            }

            public function setTest(mixed $test): self
            {
                $this->test = $test;

                return $this;
            }

            public function setMain(mixed $main): self
            {
                $this->main = $main;

                return $this;
            }

            public function setGamma(mixed $gamma): self
            {
                $this->gamma = $gamma;

                return $this;
            }

            public function setBeta(mixed $beta): self
            {
                $this->beta = $beta;

                return $this;
            }
        };
    }
}
