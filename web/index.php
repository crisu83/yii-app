<?php
// Remove the following when deploying the application into production.
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$yii = __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php';
$global = __DIR__ . '/../app/helpers/global.php';
$builder = __DIR__ . '/../vendor/crisu83/yii-configbuilder/helpers/EnvConfigBuilder.php';

require_once($yii);
require_once($global);
require_once($builder);

$config = EnvConfigBuilder::build(array(
	__DIR__ . '/../app/config/main.php',
	__DIR__ . '/../app/config/web.php',
	__DIR__ . '/../app/config/environments/{environment}.php',
	__DIR__ . '/../app/config/local.php',
), __DIR__ . '/../app/runtime/environment');

Yii::createWebApplication($config)->run();
