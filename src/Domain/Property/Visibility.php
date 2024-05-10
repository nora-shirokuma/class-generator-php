<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Property;

use Exception;

class Visibility
{
    public const VISIBILITY_PRIVATE = 'private';

    public const VISIBILITY_PROTECTED = 'protected';

    public const VISIBILITY_PUBLIC = 'public';

    private ?string $value;

    public function __construct(?string $value)
    {
        (function() use($value) {

            if ($value === self::VISIBILITY_PRIVATE) {
                return;
            }

            if ($value === self::VISIBILITY_PROTECTED) {
                return;
            }

            if ($value === self::VISIBILITY_PUBLIC) {
                return;
            }

            throw new Exception('Visibility that does not exist.');

        })();

        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}