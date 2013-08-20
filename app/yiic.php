<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

require(__DIR__ . '/../vendor/yiisoft/yii/framework/yii.php');
require(__DIR__ . '/../vendor/crisu83/yii-consoletools/helpers/ConfigHelper.php');

$config = ConfigHelper::merge(
    array(
        __DIR__ . '/config/main.php',
        __DIR__ . '/config/console.php',
        __DIR__ . '/config/main-environment.php',
        __DIR__ . '/config/console-local.php',
    )
);

$app = Yii::createConsoleApplication($config);
$app->commandRunner->addCommands(YII_PATH . '/cli/commands');
$app->run();