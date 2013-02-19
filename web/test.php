<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii = __DIR__ . '/../app/vendor/yiisoft/yii/framework/yii.php';
$globals = __DIR__ . '/../app/helpers/globals.php';
$config = __DIR__ . '/../app/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
