<?php

namespace NoraShirokuma\ClassGeneratorPhp;

class Argument
{
    private string $name;

    private ?string $type;

    private bool $nullOk;

    private bool $enableDefaultValue;

    private ?string $defaultValue;

    public function __construct(
        string $name,
        ?string $type = null,
        bool $nullOk = true,
        bool $enableDefaultValue = false,
        ?string $defaultValue = null
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->nullOk = $nullOk;
        $this->enableDefaultValue = $enableDefaultValue;
        $this->defaultValue = $defaultValue;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isNullOk(): bool
    {
        return $this->nullOk;
    }

    public function isEnableDefaultValue(): bool
    {
        return $this->enableDefaultValue;
    }

    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }
}