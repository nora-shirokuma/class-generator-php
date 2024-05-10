<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Property;

use Exception;

class Property
{
    private PropertyName $propertyName;

    private ?PropertyVisibility $propertyVisibility;

    private ?PropertyType $propertyType;

    public function __construct(
        PropertyName        $propertyName,
        ?PropertyVisibility $propertyVisibility,
        ?PropertyType       $propertyType
    )
    {
        $this->propertyName       = $propertyName;
        $this->propertyVisibility = $propertyVisibility;
        $this->propertyType       = $propertyType;

        self::validate($this);
    }

    public function getPropertyName(): PropertyName
    {
        return $this->propertyName;
    }

    public function getPropertyVisibility(): ?PropertyVisibility
    {
        return $this->propertyVisibility;
    }

    public function getPropertyType(): ?PropertyType
    {
        return $this->propertyType;
    }

    public static function validate(Property $property): void
    {
        if (strlen($property->getPropertyName()->getValue()) === 0) {
            throw new Exception("PropertyName is Empty.");
        }
    }
}