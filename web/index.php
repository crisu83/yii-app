<?php

$debugger = __DIR__ . '/../vendor/crisu83/yii-debug/helpers/Debugger.php';

require_once($debugger);

Debugger::init(__DIR__ . '/../app/runtime/debug');

$yii = __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php';
$global = __DIR__ . '/../app/helpers/global.php';
$builder = __DIR__ . '/../vendor/crisu83/yii-configbuilder/helpers/ConfigBuilder.php';

require_once($yii);
require_once($global);
require_once($builder);

$config = ConfigBuilder::buildForEnv(array(
	__DIR__ . '/../app/config/main.php',
	__DIR__ . '/../app/config/web.php',
	__DIR__ . '/../app/config/environments/{environment}.php',
	__DIR__ . '/../app/config/local.php',
), __DIR__ . '/../app/runtime/environment');

Yii::createWebApplication($config)->run();
