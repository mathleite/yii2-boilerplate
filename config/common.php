<?php

return [
    'name' => 'Yii2 Boilerplate',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'en-US',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => sprintf('mysql:host=%s;port=%s;dbname=%s',
                getenv('DB_HOST'), getenv('DB_PORT'), getenv('DB_SCHEMA')),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'charset' => 'utf8',
        ],
        'queue' => [
            'class' => '\yii\queue\file\Queue',
            'path' => '@root/runtime/queue',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'America/Sao_Paulo',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'aliases' => [
        '@vendor' => '@root/vendor',
    ],
];
