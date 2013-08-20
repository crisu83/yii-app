<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

require(__DIR__ . '/../vendor/yiisoft/yii/framework/yii.php');
require(__DIR__ . '/../app/components/WebApplication.php');
require(__DIR__ . '/../app/helpers/global.php');
require(__DIR__ . '/../vendor/crisu83/yii-consoletools/helpers/ConfigHelper.php');

$config = ConfigHelper::merge(
    array(
        __DIR__ . '/../app/config/main.php',
        __DIR__ . '/../app/config/web.php',
        __DIR__ . '/../app/config/main-environment.php',
        __DIR__ . '/../app/config/main-local.php',
    )
);

$app = Yii::createApplication('WebApplication', $config);
$app->run();