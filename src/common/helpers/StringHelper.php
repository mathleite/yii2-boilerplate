<?php

namespace common\helpers;

use yii\base\InvalidConfigException;

class StringHelper extends \yii\helpers\StringHelper
{
    public const MAC_HASH = 'sha256';

    public static function hashData($data, $key, $rawHash = false): string
    {
        if (!$hash = hash_hmac(static::MAC_HASH, $data, $key, $rawHash)) {
            throw new InvalidConfigException('Failed to generate HMAC with hash algorithm: ' . static::MAC_HASH);
        }
        return $hash;
    }

    public static function stripSpecialChars($content): string
    {
        return static::stripChars('/[^A-Za-z0-9]/', $content, true);
    }

    public static function stripChars(array|string $characters, $content, bool $regex = false): string
    {
        if ($regex) {
            return preg_replace($characters, null, $content);
        }
        return str_replace($characters, null, $content);
    }

    public static function generateRandomString($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
