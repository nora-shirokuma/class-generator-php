<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Method;

class MethodAbstract
{
    private bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function isValue(): bool
    {
        return $this->value;
    }
}