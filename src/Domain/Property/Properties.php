<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Property;

use ArrayIterator;
use IteratorAggregate;

class Properties implements IteratorAggregate
{
    private array $properties = [];

    public function __construct()
    {
    }

    public function add(Property $property): void
    {
        $this->properties[] = $property;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->properties);
    }
}