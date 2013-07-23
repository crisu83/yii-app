<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

require(__DIR__ . '/../vendor/yiisoft/yii/framework/yii.php');
require(__DIR__ . '/../app/helpers/global.php');
require(__DIR__ . '/../vendor/crisu83/yii-deploymenttools/helpers/ConfigHelper.php');

$config = ConfigHelper::build(
    array(
        __DIR__ . '/../app/config/main.php',
        __DIR__ . '/../app/config/web.php',
        __DIR__ . '/../app/config/environment.php',
        __DIR__ . '/../app/config/local.php',
    )
);

$app = Yii::createWebApplication($config);
$app->run();