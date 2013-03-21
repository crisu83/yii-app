<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

$yii = __DIR__ . '/../app/vendor/yiisoft/yii/framework/yii.php';
$global = __DIR__ . '/../app/helpers/global.php';
$builder = __DIR__ . '/../app/vendor/crisu83/yii-configbuilder/helpers/ConfigBuilder.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);
require_once($global);
require_once($builder);

$config = ConfigBuilder::build(array(
	__DIR__ . '/../app/config/main.php',
	__DIR__ . '/../app/config/test.php',
));

Yii::createWebApplication($config)->run();
