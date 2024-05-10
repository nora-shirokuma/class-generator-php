<?php

namespace NoraShirokuma\ClassGeneratorPhp;

class Method
{
    public const VISIBILITY_PRIVATE = 'private';

    public const VISIBILITY_PROTECTED = 'protected';

    public const VISIBILITY_PUBLIC = 'public';

    private string $name;

    private ?string $visibility = null;

    private array $arguments = [];

    private array $body = [];

    private ?string $returnValue = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addArgument(Argument $argument): void
    {
        $this->arguments[] = $argument;
    }

    public function setVisibility(?string $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function setReturnValue(?string $returnValue): void
    {
        $this->returnValue = $returnValue;
    }

    public function addBody(string $code): void
    {
        $this->body[] = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getReturnValue(): ?string
    {
        return $this->returnValue;
    }
}