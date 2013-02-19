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

$yii = __DIR__ . '/../app/vendor/yiisoft/yii/framework/yii.php';
$globals = __DIR__ . '/../app/globals.php';
$config = __DIR__ . '/../app/config/dev.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
