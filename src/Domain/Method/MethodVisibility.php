<?php

namespace NoraShirokuma\ClassGeneratorPhp\Domain\Method;

use Exception;

class MethodVisibility
{
    public const VISIBILITY_PRIVATE = 'private';

    public const VISIBILITY_PROTECTED = 'protected';

    public const VISIBILITY_PUBLIC = 'public';

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
        self::validate($this);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function validate(MethodVisibility $methodVisibility)
    {
        (function() use($methodVisibility) {

            $value = $methodVisibility->getValue();

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
    }
}