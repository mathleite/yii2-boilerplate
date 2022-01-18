<?php

namespace common\enums;

abstract class Enum implements EnumInterface
{
    public static function asArray() : array
    {
        $reflector = new \ReflectionClass(get_called_class());
        return $reflector->getConstants();
    }

    public static function exists(mixed $value): bool
    {
        return in_array($value, self::asArray());
    }
}
