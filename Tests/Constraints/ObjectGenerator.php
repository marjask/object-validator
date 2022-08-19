<?php

declare(strict_types=1);

namespace ObjectValidator\Tests\Constraints;

abstract class ObjectGenerator
{
    protected static function getObjectToValidate()
    {
        return new class {

            private mixed $test;
            private mixed $main;
            private mixed $gamma;
            private mixed $beta;

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
