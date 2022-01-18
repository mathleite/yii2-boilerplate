<?php

return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'runtimePath' => '@root/runtime/console',
    'bootstrap' => ['log', 'gii', 'queue'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'aliases' => [
        '@app' => '@console',
    ],
    'params' => [],
];
