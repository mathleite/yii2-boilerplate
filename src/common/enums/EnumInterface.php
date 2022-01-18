<?php

namespace common\enums;

interface EnumInterface
{
    public static function asArray() : array;
    public static function exists(mixed $value) : bool;
}
