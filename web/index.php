<?php

$app = __DIR__ . '/../app';
$yii = $app . '/vendor/yiisoft/yii/framework/yii.php';
$globals = $app . '/globals.php';
$config = $app . '/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
