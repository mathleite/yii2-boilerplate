<?php

require(__DIR__ . '/../../vendor/autoload.php');

(Dotenv\Dotenv::createUnsafeImmutable(dirname(dirname(__DIR__))))->load();

defined('YII_DEBUG') or define('YII_DEBUG', getenv('APP_DEBUG'));
defined('YII_ENV') or define('YII_ENV', getenv('ENVIRONMENT'));

require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../config/common.php'),
    require(__DIR__ . '/../../config/api.php')
);

(new yii\web\Application($config))->run();
