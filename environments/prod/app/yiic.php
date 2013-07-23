<?php

defined('YII_DEBUG') or define('YII_DEBUG', false);

defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

require(__DIR__ . '/../vendor/yiisoft/yii/framework/yii.php');
require(__DIR__ . '/../vendor/crisu83/yii-deploymenttools/helpers/ConfigHelper.php');

$config = ConfigHelper::merge(
    array(
        __DIR__ . '/config/main.php',
        __DIR__ . '/config/console.php',
    )
);

$app = Yii::createConsoleApplication($config);
$app->commandRunner->addCommands(YII_PATH . '/cli/commands');
$app->run();