<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Property;

class PropertyName
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