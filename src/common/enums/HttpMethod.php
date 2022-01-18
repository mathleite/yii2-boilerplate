<?php

namespace common\enums;

class HttpMethod extends Enum
{
    public const GET = 'GET';
    public const PATCH = 'PATCH';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const HEAD = 'HEAD';
    public const OPTIONS = 'OPTIONS';
}
