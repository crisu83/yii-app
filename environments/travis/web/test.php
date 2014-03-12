<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii/framework/yii.php');
require(__DIR__ . '/../common/helpers/global.php');
require(__DIR__ . '/../vendor/crisu83/yii-consoletools/helpers/ConfigHelper.php');

$config = ConfigHelper::merge(
    array(
        // base
        __DIR__ . '/../common/config/common.php',
        __DIR__ . '/../app/config/web.php',
        __DIR__ . '/../app/config/test.php',
        // environment
        __DIR__ . '/../common/config/common-environment.php',
        __DIR__ . '/../app/config/web-environment.php',
        __DIR__ . '/../app/config/test-environment.php',
        // local
        __DIR__ . '/../common/config/common-local.php',
        __DIR__ . '/../app/config/web-local.php',
        __DIR__ . '/../app/config/test-local.php',
    )
);

Yii::createWebApplication($config)->run();