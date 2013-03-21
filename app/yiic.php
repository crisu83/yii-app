<?php

$yii = __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php';
$builder = __DIR__ . '/../vendor/crisu83/yii-configbuilder/helpers/ConfigBuilder.php';

defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
require_once($builder);

$config = ConfigBuilder::build(array(
	__DIR__ . '/config/main.php',
	__DIR__ . '/config/console.php',
));

$app = Yii::createConsoleApplication($config);
$app->commandRunner->addCommands(YII_PATH . '/cli/commands');
$app->run();

