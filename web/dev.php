<?php

if (isset($_SERVER['HTTP_CLIENT_IP'])
	|| isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	|| !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')))
{
	header('HTTP/1.0 403 Forbidden');
	exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$yii = __DIR__ . '/../app/vendor/yiisoft/yii/framework/yii.php';
$globals = __DIR__ . '/../app/globals.php';
$config = __DIR__ . '/../app/config/dev.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
