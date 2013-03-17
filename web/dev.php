<?php
/**
 * This is the bootstrap file for the development environment.
 * This file should be removed when the application is deployed for production.
 */

// Make sure that end users cannot run this file.
if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')))
{
	header('HTTP/1.0 403 Forbidden');
	exit('You are not allowed to access this file.');
}

$yii = __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php';
$global = __DIR__ . '/../app/helpers/global.php';
$builder = __DIR__ . '/../vendor/crisu83/yii-configbuilder/ConfigBuilder.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once($yii);
require_once($global);
require_once($builder);

$config = ConfigBuilder::build(array(
	__DIR__ . '/../app/config/common.php',
	__DIR__ . '/../app/config/web.php',
	__DIR__ . '/../app/config/dev.php',
	__DIR__ . '/../app/config/local.php',
));

Yii::createWebApplication($config)->run();
