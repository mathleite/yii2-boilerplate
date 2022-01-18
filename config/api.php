<?php

$config = [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'runtimePath' => '@root/runtime/api',
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => null,
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'errorHandler' => [
            'class' => \api\rest\ErrorHandler::class
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\Client',
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => require "api/routes.php",
        ],
    ],
    'params' => [],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
