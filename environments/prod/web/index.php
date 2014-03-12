<?php

defined('YII_DEBUG') or define('YII_DEBUG', false);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii/framework/yiilite.php');
require(__DIR__ . '/../common/helpers/global.php');
require(__DIR__ . '/../vendor/crisu83/yii-consoletools/helpers/ConfigHelper.php');

$config = ConfigHelper::merge(
    array(
        // base
        __DIR__ . '/../common/config/common.php',
        __DIR__ . '/../app/config/web.php',
        // environment
        __DIR__ . '/../common/config/common-environment.php',
        __DIR__ . '/../app/config/web-environment.php',
        // local
        __DIR__ . '/../common/config/common-local.php',
        __DIR__ . '/../app/config/web-local.php',
    )
);

Yii::createWebApplication($config)->run();