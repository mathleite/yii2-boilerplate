<?php

namespace common\helpers;

use common\enums\HttpMethod;
use yii\web\GroupUrlRule;

class RouteHelper
{
    public static function get(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::GET, $pattern, $action);
    }

    public static function post(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::POST, $pattern, $action);
    }

    public static function put(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::PUT, $pattern, $action);
    }

    public static function patch(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::PATCH, $pattern, $action);
    }

    public static function delete(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::DELETE, $pattern, $action);
    }

    public static function head(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::HEAD, $pattern, $action);
    }

    public static function options(string $pattern, string $action): array
    {
        return static::createRule(HttpMethod::OPTIONS, $pattern, $action);
    }

    public static function group(string $prefix, array $routes): GroupUrlRule
    {
        return new GroupUrlRule([
            'routePrefix' => false,
            'prefix' => $prefix,
            'rules' => $routes,
        ]);
    }

    private static function createRule(string $verb, string $pattern, string $route): array
    {
        return [
            'verb' => $verb,
            'pattern' => $pattern,
            'route' => $route
        ];
    }
}
