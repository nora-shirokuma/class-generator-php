<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Method;

class MethodName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}